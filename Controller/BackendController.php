<?php
/**
 * Karaka
 *
 * PHP Version 7.4
 *
 * @package   Modules\Surveys
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\Surveys\Controller;

use Modules\Media\Models\CollectionMapper;
use Modules\Surveys\Models\SurveyTemplateMapper;
use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Surveys controller class.
 *
 * @package Modules\Surveys
 * @license OMS License 1.0
 * @link    https://karaka.app
 * @since   1.0.0
 * @codeCoverageIgnore
 */
final class BackendController extends Controller
{
    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function setUpBackend(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : void
    {
        $head = $response->get('Content')->getData('head');
        $head->addAsset(AssetType::CSS, '/Modules/Surveys/Theme/Backend/styles.css');
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewSurveysList(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Surveys/Theme/Backend/surveys-list');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000801001, $request, $response));

        $path    = \str_replace('+', ' ', (string) ($request->getData('path') ?? '/'));
        $surveys = SurveyTemplateMapper::getByVirtualPath($path)
            ->where('tags/title/language', $response->getLanguage())
            ->where('l11n/language', $response->getLanguage())
            ->execute();

        list($collection, $parent) = CollectionMapper::getCollectionsByPath($path);

        $view->addData('parent', $parent);
        $view->addData('collections', $collection);
        $view->addData('path', $path);
        $view->addData('surveys', $surveys);
        $view->addData('account', $this->app->accountManager->get($request->header->account));

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewSurveysCreate(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Surveys/Theme/Backend/surveys-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000801001, $request, $response));

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewSurveysEdit(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Surveys/Theme/Backend/surveys-create');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000801001, $request, $response));

        /** @var \Modules\Surveys\Models\SurveyTemplate $survey */
        $survey = SurveyTemplateMapper::get()
            ->with('createdBy')
            ->with('elements')
            ->with('elements/l11n')
            ->with('elements/labels')
            ->with('media')
            ->with('l11n')
            ->with('tags')
            ->with('tags/title')
            ->where('id', $request->getData('id'))
            ->where('tags/title/language', $response->getLanguage())
            ->where('l11n/language', $response->getLanguage())
            ->where('elements/l11n/language', $response->getLanguage())
            ->where('elements/labels/language', $response->getLanguage())
            ->execute();

        $view->addData('survey', $survey);

        return $view;
    }

    /**
     * Routing end-point for application behaviour.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewSurveysSurvey(RequestAbstract $request, ResponseAbstract $response, mixed $data = null) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/Surveys/Theme/Backend/surveys-survey');
        $view->addData('nav', $this->app->moduleManager->get('Navigation')->createNavigationMid(1000801001, $request, $response));

        return $view;
    }
}
