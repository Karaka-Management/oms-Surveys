<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Surveys
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
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
use phpOMS\Localization\ISO639x1Enum;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Utils\Parser\Markdown\Markdown;

/**
 * Api controller for the survey module.
 *
 * @package Modules\Surveys
 * @license OMS License 2.0
 * @link    https://jingga.app
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
        if (($val['title'] = !$request->hasData('title'))
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
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiSurveyTemplateCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateSurveyTemplateCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $survey = $this->createSurveyTemplateFromRequest($request);
        $this->createModel($request->header->account, $survey, SurveyTemplateMapper::class, 'survey', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $survey);
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
        $template->start     = $request->getDataDateTime('start');
        $template->end       = $request->getDataDateTime('end');
        $template->status    = SurveyStatus::tryFromValue($request->getDataInt('status')) ?? SurveyStatus::ACTIVE;
        $template->createdBy = new NullAccount($request->header->account);

        $l11n = new SurveyTemplateL11n(
            $request->getDataString('title') ?? '',
            Markdown::parse($request->getDataString('description') ?? ''),
            $request->getDataString('description') ?? '',
            ISO639x1Enum::tryFromValue($request->getDataString('language')) ?? ISO639x1Enum::_EN
        );

        $template->setL11n($l11n);

        /*
        if ($request->hasData('tags')) {
            $template->tags = $this->app->moduleManager->get('Tag', 'Api')->createTagsFromRequest($request);
        }
        */

        if (!empty($request->files)) {
            $uploaded = $this->app->moduleManager->get('Media', 'Api')->uploadFiles(
                names:       [],
                fileNames:   [],
                files:       $request->files,
                account:     $request->header->account,
                basePath:    __DIR__ . '/../../../Modules/Media/Files/Modules/Surveys',
                virtualPath: '/Modules/Surveys',
            );

            foreach ($uploaded->sourcess as $media) {
                $template->files[] = $media;
            }
        }

        $mediaFiles = $request->getDataJson('media');
        foreach ($mediaFiles as $media) {
            $template->files[] = new NullMedia($media);
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
            || ($val['type'] = !SurveyElementType::isValidValue($request->getDataInt('type') ?? -1))
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
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiSurveyTemplateElementCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateSurveyTemplateElementCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $element = $this->createSurveyTemplateElementFromRequest($request);
        $this->createModel($request->header->account, $element, SurveyTemplateElementMapper::class, 'element', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $element);
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
        $element->isOptional = $request->getDataBool('optional') ?? false;
        $element->order      = $request->getDataInt('order') ?? 0;
        $element->template   = $request->getDataInt('survey') ?? 0;

        $l11n = new SurveyTemplateElementL11n(
            $request->getDataString('text') ?? '',
            Markdown::parse($request->getDataString('description') ?? ''),
            $request->getDataString('description') ?? '',
            ISO639x1Enum::tryFromValue($request->getDataString('language')) ?? ISO639x1Enum::_EN
        );

        $element->setL11n($l11n);

        $labels = $request->getDataJson('labels');
        foreach ($labels as $text) {
            $label = new SurveyTemplateLabelL11n(
                $text,
                ISO639x1Enum::tryFromValue($request->getDataString('language')) ?? ISO639x1Enum::_EN
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
        if (($val['survey'] = !$request->hasData('survey'))
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
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiSurveyAnswerCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateSurveyAnswerCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $survey = $this->createSurveyAnswerFromRequest($request);
        //$this->createModel($request->header->account, $survey, SurveyAnswerMapper::class, 'survey', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $survey);
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
