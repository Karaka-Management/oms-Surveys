<?php
/**
 * Jingga
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
 * Surveys class.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class SurveyTemplateL11n implements \JsonSerializable
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    /**
     * Surveys ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $template = 0;

    /**
     * Language.
     *
     * @var string
     * @since 1.0.0
     */
    protected string $language = ISO639x1Enum::_EN;

    /**
     * Title.
     *
     * @var string
     * @since 1.0.0
     */
    public string $title = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    public string $description = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    public string $descriptionPlain = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    public string $footer = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    public string $footerPlain = '';

    /**
     * Constructor.
     *
     * @param string $title            Title
     * @param string $description      Description
     * @param string $descriptionPlain Plain description
     * @param string $language         Language code
     *
     * @since 1.0.0
     */
    public function __construct(string $title = '', string $description = '',  string $descriptionPlain = '', string $language = ISO639x1Enum::_EN)
    {
        $this->title            = $title;
        $this->description      = $description;
        $this->descriptionPlain = $descriptionPlain;
        $this->language         = $language;
    }

    /**
     * Get language
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getLanguage() : string
    {
        return $this->language;
    }

    /**
     * Set language
     *
     * @param string $language Language
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setLanguage(string $language) : void
    {
        $this->language = $language;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'                  => $this->id,
            'title'               => $this->title,
            'description'         => $this->description,
            'descriptionPlain'    => $this->descriptionPlain,
            'template'            => $this->template,
            'language'            => $this->language,
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
