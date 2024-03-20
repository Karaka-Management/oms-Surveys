<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Surveys\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Surveys\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Survey status enum.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class SurveyStatus extends Enum
{
    public const ACTIVE = 1;
}
