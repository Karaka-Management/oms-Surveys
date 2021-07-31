<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\Surveys\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Surveys\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

/**
 * Tag mapper class.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class SurveyTemplateElementL11nMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'survey_template_element_l11n_id'       => ['name' => 'survey_template_element_l11n_id',       'type' => 'int',    'internal' => 'id'],
        'survey_template_element_l11n_text'    => ['name' => 'survey_template_element_l11n_text',    'type' => 'string', 'internal' => 'text', 'autocomplete' => true],
        'survey_template_element_l11n_description'    => ['name' => 'survey_template_element_l11n_description',    'type' => 'string', 'internal' => 'description'],
        'survey_template_element_l11n_description_plain'    => ['name' => 'survey_template_element_l11n_description_plain',    'type' => 'string', 'internal' => 'descriptionPlain'],
        'survey_template_element_l11n_element'      => ['name' => 'survey_template_element_l11n_element',      'type' => 'int',    'internal' => 'element'],
        'survey_template_element_l11n_language' => ['name' => 'survey_template_element_l11n_language', 'type' => 'string', 'internal' => 'language'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'survey_template_element_l11n';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'survey_template_element_l11n_id';
}
