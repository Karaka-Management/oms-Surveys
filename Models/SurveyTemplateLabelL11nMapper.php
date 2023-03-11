<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\Surveys\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Surveys\Models;

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Tag mapper class.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 1.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class SurveyTemplateLabelL11nMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'survey_template_element_label_l11n_id'           => ['name' => 'survey_template_element_label_l11n_id',       'type' => 'int',    'internal' => 'id'],
        'survey_template_element_label_l11n_title'        => ['name' => 'survey_template_element_label_l11n_title',    'type' => 'string', 'internal' => 'title', 'autocomplete' => true],
        'survey_template_element_label_l11n_element'      => ['name' => 'survey_template_element_label_l11n_element',      'type' => 'int',    'internal' => 'element'],
        'survey_template_element_label_l11n_order'        => ['name' => 'survey_template_element_label_l11n_order',      'type' => 'int',    'internal' => 'order'],
        'survey_template_element_label_l11n_language'     => ['name' => 'survey_template_element_label_l11n_language', 'type' => 'string', 'internal' => 'language'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'survey_template_element_label_l11n';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'survey_template_element_label_l11n_id';
}
