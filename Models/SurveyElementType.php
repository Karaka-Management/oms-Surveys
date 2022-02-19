<?php
/**
 * Karaka
 *
 * PHP Version 8.0
 *
 * @package   Modules\Surveys\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\Surveys\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Survey element status enum.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 1.0
 * @link    https://karaka.app
 * @since   1.0.0
 */
abstract class SurveyElementType extends Enum
{
    public const HEADLINE = 1;

    public const DROPDOWN = 2;

    public const CHECKBOX = 3;

    public const RADIO = 4;

    public const TEXTFIELD = 5;

    public const TEXTAREA = 6;

    public const NUMERIC = 7;

    public const DATE = 8;
}
