<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\Surveys
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
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
 * @license OMS License 2.0
 * @link    https://jingga.app
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
        $head = $response->get('Content')->head;
        $head->addAsset(AssetType::CSS, '/Modules/Surveys/Theme/Backend/styles.css?v=1.0.0');
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
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1000801001, $request, $response);

        $path    = \str_replace('+', ' ', (string) ($request->getData('path') ?? '/'));
        $surveys = SurveyTemplateMapper::getByVirtualPath($path)
            ->where('tags/title/language', $response->header->l11n->language)
            ->where('l11n/language', $response->header->l11n->language)
            ->execute();

        list($collection, $parent) = CollectionMapper::getCollectionsByPath($path);

        $view->data['parent'] = $parent;
        $view->data['collections'] = $collection;
        $view->data['path'] = $path;
        $view->data['surveys'] = $surveys;
        $view->data['account'] = $this->app->accountManager->get($request->header->account);

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
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1000801001, $request, $response);

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
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1000801001, $request, $response);

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
            ->where('tags/title/language', $response->header->l11n->language)
            ->where('l11n/language', $response->header->l11n->language)
            ->where('elements/l11n/language', $response->header->l11n->language)
            ->where('elements/labels/language', $response->header->l11n->language)
            ->execute();

        $view->data['survey'] = $survey;

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
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1000801001, $request, $response);

        return $view;
    }
}
