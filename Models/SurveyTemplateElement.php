<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\Surveys\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Surveys\Models;

use phpOMS\Localization\ISO639x1Enum;

/**
 * Survey class.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class SurveyTemplateElement
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Type.
     *
     * @var int
     * @since 1.0.0
     */
    public int $type = SurveyElementType::CHECKBOX;

    /**
     * Optional.
     *
     * @var bool
     * @since 1.0.0
     */
    public bool $isOptional = false;

    /**
     * Order.
     *
     * @var int
     * @since 1.0.0
     */
    public int $order = 0;

    /**
     * Template.
     *
     * @var int
     * @since 1.0.0
     */
    public int $template = 0;

    /**
     * L11n.
     *
     * @var null|SurveyTemplateElementL11n
     * @since 1.0.0
     */
    protected ?SurveyTemplateElementL11n $l11n = null;

    /**
     * Labels.
     *
     * @var SurveyTemplateLabelL11n[]
     * @since 1.0.0
     */
    protected array $labels = [];

    /**
     * Values.
     *
     * @var array
     * @since 1.0.0
     */
    public array $values = [];

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
     * @return SurveyTemplateElementL11n
     *
     * @since 1.0.0
     */
    public function getL11n() : SurveyTemplateElementL11n
    {
        return $this->l11n ?? new NullSurveyTemplateElementL11n();
    }

    /**
     * Set l11n
     *
     * @param SurveyTemplateElementL11n $l11n Template l11n
     * @param string                    $lang Language
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setL11n(SurveyTemplateElementL11n $l11n, string $lang = ISO639x1Enum::_EN) : void
    {
        $this->l11n = $l11n;
    }

    /**
     * @param SurveyTemplateLabelL11n $label Label
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addLabel(SurveyTemplateLabelL11n $label) : void
    {
        $this->labels[] = $label;
    }

    /**
     * @return array
     *
     * @since 1.0.0
     */
    public function getLabels() : array
    {
        return $this->labels;
    }

    /**
     * @param mixed $value Label value
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addValue($value) : void
    {
        $this->values[] = $value;
    }

    /**
     * @return array
     *
     * @since 1.0.0
     */
    public function getValues() : array
    {
        return $this->values;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'               => $this->id,
            'type'             => $this->type,
            'isOptional'       => $this->isOptional,
            'order'            => $this->order,
            'template'         => $this->template,
            'labels'           => $this->labels,
            'values'           => $this->values,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : mixed
    {
        return $this->toArray();
    }
}
