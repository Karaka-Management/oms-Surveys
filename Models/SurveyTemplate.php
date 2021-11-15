<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Surveys\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Surveys\Models;

use Modules\Admin\Models\Account;
use Modules\Media\Models\Media;
use Modules\Tag\Models\Tag;
use phpOMS\Localization\ISO639x1Enum;

/**
 * Survey class.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class SurveyTemplate
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Status.
     *
     * @var int
     * @since 1.0.0
     */
    public int $status = SurveyStatus::ACTIVE;

    /**
     * Public result.
     *
     * Should the result of the survey be made public?
     *
     * @var bool
     * @since 1.0.0
     */
    public bool $hasPublicResult = true;

    /**
     * Created.
     *
     * @var \DateTimeImmutable
     * @since 1.0.0
     */
    public \DateTimeImmutable $createdAt;

    /**
     * Start.
     *
     * @var null|\DateTime
     * @since 1.0.0
     */
    public ?\DateTime $start = null;

    /**
     * End.
     *
     * @var null|\DateTime
     * @since 1.0.0
     */
    public ?\DateTime $end = null;

    /**
     * Creator.
     *
     * @var Account
     * @since 1.0.0
     */
    public Account $createdBy;

    /**
     * L11n.
     *
     * @var null|SurveyTemplateL11n
     * @since 1.0.0
     */
    protected ?SurveyTemplateL11n $l11n = null;

    /**
     * Path for organizing.
     *
     * @var string
     * @since 1.0.0
     */
    public string $virtualPath = '/';

    /**
     * Tags.
     *
     * @var Tag[]
     * @since 1.0.0
     */
    private array $tags = [];

    /**
     * Elements.
     *
     * @var SurveyTemplateElement[]
     * @since 1.0.0
     */
    private array $elements = [];

    /**
     * Media files
     *
     * @var Media[]
     * @since 1.0.0
     */
    protected array $media = [];

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable('now');
    }

    /**
     * Get id.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return SurveyTemplateL11n
     *
     * @since 1.0.0
     */
    public function getL11n() : SurveyTemplateL11n
    {
        return $this->l11n ?? new NullSurveyTemplateL11n();
    }

    /**
     * Set l11n
     *
     * @param SurveyTemplateL11n $l11n Template l11n
     * @param string             $lang Language
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setL11n(SurveyTemplateL11n $l11n, string $lang = ISO639x1Enum::_EN) : void
    {
        $this->l11n = $l11n;
    }

    /**
     * Get tags
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getTags() : array
    {
        return $this->tags;
    }

    /**
     * Get tag.
     *
     * @param int $id Element id
     *
     * @return Tag
     *
     * @since 1.0.0
     */
    public function getTag(int $id) : Tag
    {
        return $this->tags[$id] ?? new NullTag();
    }

    /**
     * Add tag
     *
     * @param Tag $tag Tag
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addTag(Tag $tag) : void
    {
        $this->tags[] = $tag;
    }

    /**
     * Remove Tag from list.
     *
     * @param int $id Tag
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function removeTag($id) : bool
    {
        if (isset($this->tags[$id])) {
            unset($this->tags[$id]);

            return true;
        }

        return false;
    }

    /**
     * Get all media
     *
     * @return Media[]
     *
     * @since 1.0.0
     */
    public function getMedia() : array
    {
        return $this->media;
    }

    /**
     * Add media
     *
     * @param Media $media Media to add
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addMedia(Media $media) : void
    {
        $this->media[] = $media;
    }

    /**
     * Get elements
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getElements() : array
    {
        return $this->elements;
    }

    /**
     * Add element
     *
     * @param SurveyTemplateElement $element Survey element to add
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addElement(SurveyTemplateElement $element) : void
    {
        $this->elements[] = $element;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'              => $this->id,
            'status'          => $this->status,
            'hasPublicResult' => $this->hasPublicResult,
            'createdAt'       => $this->createdAt,
            'start'           => $this->start,
            'end'             => $this->end,
            'virtualPath'     => $this->virtualPath,
            'tags'            => $this->tags,
            'elements'        => $this->elements,
            'media'           => $this->media,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
