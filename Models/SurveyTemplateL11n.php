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

use phpOMS\Contract\ArrayableInterface;
use phpOMS\Localization\ISO639x1Enum;

/**
 * Surveys class.
 *
 * @package Modules\Surveys\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class SurveyTemplateL11n implements \JsonSerializable, ArrayableInterface
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Surveys ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $template = 0;

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
     * Get id
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
     * Set template.
     *
     * @param int $template Surveys id
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setSurvey(int $template) : void
    {
        $this->template = $template;
    }

    /**
     * Get template
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getSurvey() : int
    {
        return $this->template;
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
            'id'       => $this->id,
            'title'    => $this->title,
            'description'    => $this->description,
            'template'      => $this->template,
            'language' => $this->language,
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