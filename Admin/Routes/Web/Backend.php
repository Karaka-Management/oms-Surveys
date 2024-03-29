<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\Surveys\Controller\BackendController;
use Modules\Surveys\Models\PermissionCategory;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^/survey(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Surveys\Controller\BackendController:setUpBackend',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SURVEY_ANSWER,
            ],
        ],
    ],
    '^/survey/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Surveys\Controller\BackendController:viewSurveysList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SURVEY_TEMPLATE,
            ],
        ],
    ],
    '^/survey/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Surveys\Controller\BackendController:viewSurveysCreate',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::SURVEY_TEMPLATE,
            ],
        ],
    ],
    '^/survey/edit(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Surveys\Controller\BackendController:viewSurveysEdit',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SURVEY_TEMPLATE,
            ],
        ],
    ],
    '^/survey(\?.*$|$)' => [
        [
            'dest'       => '\Modules\Surveys\Controller\BackendController:viewSurveysSurvey',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SURVEY_ANSWER,
            ],
        ],
    ],
];
