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
 * Mapper class.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class SurveyTemplateElementMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'survey_template_element_id'             => ['name' => 'survey_template_element_id',          'type' => 'int',      'internal' => 'id'],
        'survey_template_element_type'           => ['name' => 'survey_template_element_type',      'type' => 'int',      'internal' => 'type'],
        'survey_template_element_order'          => ['name' => 'survey_template_element_order',     'type' => 'int',      'internal' => 'order'],
        'survey_template_element_optional'       => ['name' => 'survey_template_element_optional',     'type' => 'bool',      'internal' => 'isOptional'],
        'survey_template_element_values'         => ['name' => 'survey_template_element_values',     'type' => 'Json',      'internal' => 'values'],
        'survey_template_element_template'       => ['name' => 'survey_template_element_template',     'type' => 'int',      'internal' => 'template'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'l11n' => [
            'mapper'            => SurveyTemplateElementL11nMapper::class,
            'table'             => 'survey_template_element_l11n',
            'self'              => 'survey_template_element_l11n_element',
            'conditional'       => true,
            'external'          => null,
        ],
        'labels' => [
            'mapper'            => SurveyTemplateLabelL11nMapper::class,
            'table'             => 'survey_template_element_label_l11n',
            'self'              => 'survey_template_element_label_l11n_element',
            'conditional'       => true,
            'external'          => null,
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'survey_template_element';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'survey_template_element_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'survey_template_element_id';
}
