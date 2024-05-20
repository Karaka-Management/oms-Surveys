<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\Surveys\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Surveys\Models;

use Modules\Admin\Models\Account;
use Modules\Tag\Models\Tag;
use phpOMS\Localization\ISO639x1Enum;

/**
 * Survey class.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
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
    public int $id = 0;

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
    public ?SurveyTemplateL11n $l11n = null;

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
    public array $tags = [];

    /**
     * Elements.
     *
     * @var SurveyTemplateElement[]
     * @since 1.0.0
     */
    public array $elements = [];

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
            'media'           => $this->files,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : mixed
    {
        return $this->toArray();
    }

    use \Modules\Media\Models\MediaListTrait;
}
