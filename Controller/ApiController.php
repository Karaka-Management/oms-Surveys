<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\Surveys
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\Surveys\Controller;

use Modules\Admin\Models\NullAccount;
use Modules\Media\Models\NullMedia;
use Modules\Surveys\Models\SurveyAnswer;
use Modules\Surveys\Models\SurveyElementType;
use Modules\Surveys\Models\SurveyStatus;
use Modules\Surveys\Models\SurveyTemplate;
use Modules\Surveys\Models\SurveyTemplateElement;
use Modules\Surveys\Models\SurveyTemplateElementL11n;
use Modules\Surveys\Models\SurveyTemplateElementMapper;
use Modules\Surveys\Models\SurveyTemplateL11n;
use Modules\Surveys\Models\SurveyTemplateLabelL11n;
use Modules\Surveys\Models\SurveyTemplateMapper;
use Modules\Tag\Models\NullTag;
use phpOMS\Localization\ISO639x1Enum;
use phpOMS\Message\Http\HttpResponse;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\NotificationLevel;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Message\FormValidation;
use phpOMS\Utils\Parser\Markdown\Markdown;

/**
 * Api controller for the survey module.
 *
 * @package Modules\Surveys
 * @license OMS License 1.0
 * @link    https://karaka.app
 * @since   1.0.0
 */
final class ApiController extends Controller
{
    /**
     * Validate survey create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateSurveyTemplateCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create a survey
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiSurveyTemplateCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateSurveyTemplateCreate($request))) {
            $response->set($request->uri->__toString(), new FormValidation($val));
            $response->header->status = RequestStatusCode::R_400;

            return;
        }

        $survey = $this->createSurveyTemplateFromRequest($request);
        $this->createModel($request->header->account, $survey, SurveyTemplateMapper::class, 'survey', $request->getOrigin());
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'SurveyTemplate', 'SurveyTemplate successfully created.', $survey);
    }

    /**
     * Method to create survey from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return SurveyTemplate Returns the created survey from the request
     *
     * @since 1.0.0
     */
    public function createSurveyTemplateFromRequest(RequestAbstract $request) : SurveyTemplate
    {
        $template            = new SurveyTemplate();
        $template->start     = empty($request->getData('start')) ? null : new \DateTime($request->getData('start'));
        $template->end       = empty($request->getData('end')) ? null : new \DateTime($request->getData('end'));
        $template->status    = $request->getData('status') ?? SurveyStatus::ACTIVE;
        $template->createdBy = new NullAccount($request->header->account);

        $l11n = new SurveyTemplateL11n(
            $request->getData('title') ?? '',
            Markdown::parse((string) ($request->getData('description') ?? '')),
            $request->getData('description') ?? '',
            $request->getData('language') ?? ISO639x1Enum::_EN
        );

        $template->setL11n($l11n);

        if (!empty($tags = $request->getDataJson('tags'))) {
            foreach ($tags as $tag) {
                if (!isset($tag['id'])) {
                    $request->setData('title', $tag['title'], true);
                    $request->setData('color', $tag['color'], true);
                    $request->setData('icon', $tag['icon'] ?? null, true);
                    $request->setData('language', $tag['language'], true);

                    $internalResponse = new HttpResponse();
                    $this->app->moduleManager->get('Tag')->apiTagCreate($request, $internalResponse, null);
                    $template->addTag($internalResponse->get($request->uri->__toString())['response']);
                } else {
                    $template->addTag(new NullTag((int) $tag['id']));
                }
            }
        }

        if (!empty($uploadedFiles = $request->getFiles())) {
            $uploaded = $this->app->moduleManager->get('Media')->uploadFiles(
                [],
                [],
                $uploadedFiles,
                $request->header->account,
                __DIR__ . '/../../../Modules/Media/Files/Modules/Surveys',
                '/Modules/Surveys',
            );

            foreach ($uploaded as $media) {
                $template->addMedia($media);
            }
        }

        if (!empty($mediaFiles = $request->getDataJson('media'))) {
            foreach ($mediaFiles as $media) {
                $template->addMedia(new NullMedia($media));
            }
        }

        return $template;
    }

    /**
     * Validate task create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateSurveyTemplateElementCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['survey'] = empty((int) ($request->getData('survey'))))
            || ($val['type'] = !SurveyElementType::isValidValue((int) ($request->getData('type') ?? -1)))
            || ($val['labels_values'] = (($lCount = \count($request->getDataJson('labels'))) > 0
                    && \count($request->getDataJson('values')) !== $lCount)
                )
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create a element
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiSurveyTemplateElementCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateSurveyTemplateElementCreate($request))) {
            $response->set($request->uri->__toString(), new FormValidation($val));
            $response->header->status = RequestStatusCode::R_400;

            return;
        }

        $element = $this->createSurveyTemplateElementFromRequest($request);
        $this->createModel($request->header->account, $element, SurveyTemplateElementMapper::class, 'element', $request->getOrigin());
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'SurveyTemplateElement', 'SurveyTemplateElement successfully created.', $element);
    }

    /**
     * Method to create element from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return SurveyTemplateElement Returns the created element from the request
     *
     * @since 1.0.0
     */
    public function createSurveyTemplateElementFromRequest(RequestAbstract $request) : SurveyTemplateElement
    {
        $element             = new SurveyTemplateElement();
        $element->type       = (int) $request->getData('type');
        $element->isOptional = (bool) ($request->getData('optional') ?? false);
        $element->order      = (int) ($request->getData('order') ?? 0);
        $element->template   = (int) ($request->getData('survey') ?? 0);

        $l11n = new SurveyTemplateElementL11n(
            $request->getData('text') ?? '',
            Markdown::parse((string) ($request->getData('description') ?? '')),
            $request->getData('description') ?? '',
            $request->getData('language') ?? ISO639x1Enum::_EN
        );

        $element->setL11n($l11n);

        $labels = $request->getDataJson('labels');
        foreach ($labels as $text) {
            $label = new SurveyTemplateLabelL11n(
                $text,
                $request->getData('language') ?? ISO639x1Enum::_EN
            );

            $element->addLabel($label);
        }

        $element->values = $request->getDataJson('values');

        return $element;
    }

    /**
     * Validate survey create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateSurveyAnswerCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['survey'] = empty($request->getData('survey')))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create a survey
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiSurveyAnswerCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        if (!empty($val = $this->validateSurveyAnswerCreate($request))) {
            $response->set($request->uri->__toString(), new FormValidation($val));
            $response->header->status = RequestStatusCode::R_400;

            return;
        }

        $survey = $this->createSurveyAnswerFromRequest($request);
        //$this->createModel($request->header->account, $survey, SurveyAnswerMapper::class, 'survey', $request->getOrigin());
        $this->fillJsonResponse($request, $response, NotificationLevel::OK, 'SurveyAnswer', 'SurveyAnswer successfully created.', $survey);
    }

    /**
     * Method to create survey from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return SurveyAnswer Returns the created survey from the request
     *
     * @since 1.0.0
     */
    public function createSurveyAnswerFromRequest(RequestAbstract $request) : SurveyAnswer
    {
        $answer = new SurveyAnswer();

        $values = $request->getLike('e_\d');

        return $answer;
    }
}
