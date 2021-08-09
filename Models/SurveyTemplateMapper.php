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

use Modules\Admin\Models\AccountMapper;
use Modules\Media\Models\CollectionMapper;
use Modules\Media\Models\MediaMapper;
use Modules\Tag\Models\TagMapper;
use phpOMS\DataStorage\Database\DataMapperAbstract;
use phpOMS\DataStorage\Database\RelationType;

/**
 * Mapper class.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
final class SurveyTemplateMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    protected static array $columns = [
        'survey_template_id'            => ['name' => 'survey_template_id',          'type' => 'int',      'internal' => 'id'],
        'survey_template_status'        => ['name' => 'survey_template_status',      'type' => 'int',      'internal' => 'status'],
        'survey_template_public_result'        => ['name' => 'survey_template_public_result',      'type' => 'bool',      'internal' => 'hasPublicResult'],
        'survey_template_start'    => ['name' => 'survey_template_start',  'type' => 'DateTime',     'internal' => 'start'],
        'survey_template_end'      => ['name' => 'survey_template_end',    'type' => 'DateTime',     'internal' => 'end'],
        'survey_template_virtual'       => ['name' => 'survey_template_virtual',       'type' => 'string',   'internal' => 'virtualPath'],
        'survey_template_created_by'       => ['name' => 'survey_template_created_by',     'type' => 'int',      'internal' => 'createdBy'],
        'survey_template_created_at'       => ['name' => 'survey_template_created_at',     'type' => 'DateTimeImmutable', 'internal' => 'createdAt'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    protected static array $hasMany = [
        'elements' => [
            'mapper'       => SurveyTemplateElementMapper::class,
            'table'        => 'survey_template_element',
            'self'         => 'survey_template_element_template',
            'external'     => null,
        ],
        'l11n' => [
            'mapper'            => SurveyTemplateL11nMapper::class,
            'table'             => 'survey_template_l11n',
            'self'              => 'survey_template_l11n_template',
            'conditional'       => true,
            'external'          => null,
        ],
        'tags' => [
            'mapper'   => TagMapper::class,
            'table'    => 'survey_template_tag',
            'self'     => 'survey_template_tag_dst',
            'external' => 'survey_template_tag_src',
        ],
        'media'        => [
            'mapper'   => MediaMapper::class,
            'table'    => 'survey_template_media',
            'external' => 'survey_template_media_dst',
            'self'     => 'survey_template_media_src',
        ],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, external:string}>
     * @since 1.0.0
     */
    protected static array $belongsTo = [
        'createdBy' => [
            'mapper'     => AccountMapper::class,
            'external'   => 'survey_template_created_by',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $table = 'survey_template';

    /**
     * Created at.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $createdAt = 'survey_template_created_at';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static string $primaryField = 'survey_template_id';

    /**
     * Get editor doc based on virtual path.
     *
     * @param string $virtualPath Virtual path
     *
     * @return array
     *
     * @since 1.0.0
     */
    public static function getByVirtualPath(string $virtualPath = '/') : array
    {
        $depth = 2;
        $query = self::getQuery(depth: $depth);
        $query->where(self::$table . '_d' . $depth . '.survey_template_virtual', '=', $virtualPath);

        return self::getAllByQuery($query, RelationType::ALL, $depth);
    }
}
