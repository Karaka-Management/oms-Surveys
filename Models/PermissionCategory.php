<?php
/**
 * Karaka
 *
 * PHP Version 7.4
 *
 * @package   Modules\Surveys\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Surveys\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permision state enum.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 1.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class PermissionCategory extends Enum
{
    public const SURVEY_TEMPLATE = 1;

    public const SURVEY_ANSWER = 2;

    public const SURVEY_PUBLIC_STATISTICS = 3;

    public const SURVEY_ADMIN_STATISTICS = 4;
}
