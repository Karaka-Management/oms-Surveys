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

use phpOMS\Localization\ISO639x1Enum;
use Modules\Admin\Models\Account;
use Modules\Tag\Models\Tag;

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
     * @var int
     * @since 1.0.0
     */
    public bool $hasPublicResult = true;

    /**
     * Created.
     *
     * @var \DateTime
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
    private string $virtualPath = '/';

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
        return $this->l11n;
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
}
