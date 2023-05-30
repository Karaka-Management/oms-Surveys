<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Surveys\tests\Models;

use Modules\Surveys\Models\SurveyTemplateElementL11n;
use phpOMS\Localization\ISO639x1Enum;

/**
 * @internal
 */
final class SurveyTemplateElementL11nTest extends \PHPUnit\Framework\TestCase
{
    private SurveyTemplateElementL11n $l11n;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->l11n = new SurveyTemplateElementL11n();
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateElementL11n
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->l11n->id);
        self::assertEquals('', $this->l11n->text);
        self::assertEquals('', $this->l11n->description);
        self::assertEquals('', $this->l11n->descriptionPlain);
        self::assertEquals(ISO639x1Enum::_EN, $this->l11n->language);
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateElementL11n
     * @group module
     */
    public function testTextInputOutput() : void
    {
        $this->l11n->text = 'TestName';
        self::assertEquals('TestName', $this->l11n->text);
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateElementL11n
     * @group module
     */
    public function testDescriptionInputOutput() : void
    {
        $this->l11n->description = 'TestContent';
        self::assertEquals('TestContent', $this->l11n->description);
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateElementL11n
     * @group module
     */
    public function testLanguageInputOutput() : void
    {
        $this->l11n->setLanguage(ISO639x1Enum::_DE);
        self::assertEquals(ISO639x1Enum::_DE, $this->l11n->language);
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateElementL11n
     * @group module
     */
    public function testSerialize() : void
    {
        $this->l11n->text             = 'Title';
        $this->l11n->description      = 'Content';
        $this->l11n->descriptionPlain = 'ContentPlain';
        $this->l11n->element          = 2;
        $this->l11n->setLanguage(ISO639x1Enum::_DE);

        self::assertEquals(
            [
                'id'                    => 0,
                'text'                  => 'Title',
                'description'           => 'Content',
                'descriptionPlain'      => 'ContentPlain',
                'element'               => 2,
                'language'              => ISO639x1Enum::_DE,
            ],
            $this->l11n->jsonSerialize()
        );
    }
}
