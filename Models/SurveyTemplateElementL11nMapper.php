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

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Tag mapper class.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 1.0
 * @link    https://karaka.app
 * @since   1.0.0
 */
final class SurveyTemplateElementL11nMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'survey_template_element_l11n_id'                   => ['name' => 'survey_template_element_l11n_id',       'type' => 'int',    'internal' => 'id'],
        'survey_template_element_l11n_text'                 => ['name' => 'survey_template_element_l11n_text',    'type' => 'string', 'internal' => 'text', 'autocomplete' => true],
        'survey_template_element_l11n_description'          => ['name' => 'survey_template_element_l11n_description',    'type' => 'string', 'internal' => 'description'],
        'survey_template_element_l11n_description_plain'    => ['name' => 'survey_template_element_l11n_description_plain',    'type' => 'string', 'internal' => 'descriptionPlain'],
        'survey_template_element_l11n_element'              => ['name' => 'survey_template_element_l11n_element',      'type' => 'int',    'internal' => 'element'],
        'survey_template_element_l11n_language'             => ['name' => 'survey_template_element_l11n_language', 'type' => 'string', 'internal' => 'language'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'survey_template_element_l11n';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD ='survey_template_element_l11n_id';
}
