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

use Modules\Media\Models\Media;
use Modules\Surveys\Models\SurveyStatus;
use Modules\Surveys\Models\SurveyTemplate;
use Modules\Surveys\Models\SurveyTemplateElement;
use Modules\Surveys\Models\SurveyTemplateL11n;
use Modules\Tag\Models\Tag;

/**
 * @internal
 */
final class SurveyTemplateTest extends \PHPUnit\Framework\TestCase
{
    private SurveyTemplate $survey;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->survey = new SurveyTemplate();
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplate
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->survey->id);

        $date = new \DateTime('now');
        self::assertEquals([], $this->survey->getElements());
        self::assertEquals([], $this->survey->getTags());
        self::assertEquals([], $this->survey->getMedia());
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplate
     * @group module
     */
    public function testTagInputOutput() : void
    {
        $tag = new Tag();
        $tag->setL11n('Tag');

        $this->survey->addTag($tag);
        self::assertEquals($tag, $this->survey->getTag(0));
        self::assertCount(1, $this->survey->getTags());
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplate
     * @group module
     */
    public function testTagRemove() : void
    {
        $tag = new Tag();
        $tag->setL11n('Tag');

        $this->survey->addTag($tag);
        self::assertTrue($this->survey->removeTag(0));
        self::assertCount(0, $this->survey->getTags());
        self::assertFalse($this->survey->removeTag(0));
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplate
     * @group module
     */
    public function testMediaInputOutput() : void
    {
        $this->survey->addMedia(new Media());
        self::assertCount(1, $this->survey->getMedia());
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplate
     * @group module
     */
    public function testElementInputOutput() : void
    {
        $this->survey->addElement(new SurveyTemplateElement());
        self::assertCount(1, $this->survey->getElements());
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplate
     * @group module
     */
    public function testL11nInputOutput() : void
    {
        $this->survey->setL11n(new SurveyTemplateL11n('NewTest'));
        self::assertEquals('NewTest', $this->survey->getL11n()->title);
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplate
     * @group module
     */
    public function testSerialize() : void
    {
        $this->survey->hasPublicResult       = false;
        $this->survey->start                 = new \DateTime('now');
        $this->survey->end                   = new \DateTime('now');
        $this->survey->virtualPath           = 'test/path';

        $serialized = $this->survey->jsonSerialize();
        unset($serialized['createdAt']);

        self::assertEquals(
            [
                'id'              => 0,
                'status'          => SurveyStatus::ACTIVE,
                'hasPublicResult' => false,
                'start'           => $this->survey->start,
                'end'             => $this->survey->end,
                'virtualPath'     => 'test/path',
                'tags'            => [],
                'elements'        => [],
                'media'           => [],
            ],
            $serialized
        );
    }
}
