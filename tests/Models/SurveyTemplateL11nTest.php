<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\Surveys\tests\Models;

use Modules\Surveys\Models\SurveyTemplateL11n;
use phpOMS\Localization\ISO639x1Enum;

/**
 * @internal
 */
final class SurveyTemplateL11nTest extends \PHPUnit\Framework\TestCase
{
    private SurveyTemplateL11n $l11n;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->l11n = new SurveyTemplateL11n();
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateL11n
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->l11n->getId());
        self::assertEquals('', $this->l11n->title);
        self::assertEquals('', $this->l11n->description);
        self::assertEquals('', $this->l11n->descriptionPlain);
        self::assertEquals(ISO639x1Enum::_EN, $this->l11n->getLanguage());
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateL11n
     * @group module
     */
    public function testTextInputOutput() : void
    {
        $this->l11n->title = 'TestName';
        self::assertEquals('TestName', $this->l11n->title);
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateL11n
     * @group module
     */
    public function testDescriptionInputOutput() : void
    {
        $this->l11n->description = 'TestContent';
        self::assertEquals('TestContent', $this->l11n->description);
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateL11n
     * @group module
     */
    public function testLanguageInputOutput() : void
    {
        $this->l11n->setLanguage(ISO639x1Enum::_DE);
        self::assertEquals(ISO639x1Enum::_DE, $this->l11n->getLanguage());
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateL11n
     * @group module
     */
    public function testSerialize() : void
    {
        $this->l11n->title            = 'Title';
        $this->l11n->description      = 'Content';
        $this->l11n->descriptionPlain = 'ContentPlain';
        $this->l11n->template         = 2;
        $this->l11n->setLanguage(ISO639x1Enum::_DE);

        self::assertEquals(
            [
                'id'                    => 0,
                'title'                 => 'Title',
                'description'           => 'Content',
                'descriptionPlain'      => 'ContentPlain',
                'template'              => 2,
                'language'              => ISO639x1Enum::_DE,
            ],
            $this->l11n->jsonSerialize()
        );
    }
}
