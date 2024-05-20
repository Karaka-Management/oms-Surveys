<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\Surveys\tests\Models;

use Modules\Surveys\Models\SurveyTemplateL11n;
use phpOMS\Localization\ISO639x1Enum;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\Surveys\Models\SurveyTemplateL11n::class)]
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

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        self::assertEquals(0, $this->l11n->id);
        self::assertEquals('', $this->l11n->title);
        self::assertEquals('', $this->l11n->description);
        self::assertEquals('', $this->l11n->descriptionPlain);
        self::assertEquals(ISO639x1Enum::_EN, $this->l11n->language);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testTextInputOutput() : void
    {
        $this->l11n->title = 'TestName';
        self::assertEquals('TestName', $this->l11n->title);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDescriptionInputOutput() : void
    {
        $this->l11n->description = 'TestContent';
        self::assertEquals('TestContent', $this->l11n->description);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testSerialize() : void
    {
        $this->l11n->title            = 'Title';
        $this->l11n->description      = 'Content';
        $this->l11n->descriptionPlain = 'ContentPlain';
        $this->l11n->template         = 2;
        $this->l11n->language         = ISO639x1Enum::_DE;

        self::assertEquals(
            [
                'id'               => 0,
                'title'            => 'Title',
                'description'      => 'Content',
                'descriptionPlain' => 'ContentPlain',
                'template'         => 2,
                'language'         => ISO639x1Enum::_DE,
            ],
            $this->l11n->jsonSerialize()
        );
    }
}
