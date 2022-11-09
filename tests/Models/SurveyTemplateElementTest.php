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

use Modules\Surveys\Models\SurveyElementType;
use Modules\Surveys\Models\SurveyTemplateElement;
use Modules\Surveys\Models\SurveyTemplateElementL11n;
use Modules\Surveys\Models\SurveyTemplateLabelL11n;

/**
 * @internal
 */
final class SurveyTemplateElementTest extends \PHPUnit\Framework\TestCase
{
    private SurveyTemplateElement $element;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        $this->element = new SurveyTemplateElement();
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateElement
     * @group module
     */
    public function testDefault() : void
    {
        self::assertEquals(0, $this->element->getId());

        $date = new \DateTime('now');
        self::assertEquals([], $this->element->getLabels());
        self::assertEquals([], $this->element->getValues());
        self::assertInstanceOf('\Modules\Surveys\Models\SurveyTemplateElementL11n', $this->element->getL11n());
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateElement
     * @group module
     */
    public function testL11nInputOutput() : void
    {
        $this->element->setL11n(new SurveyTemplateElementL11n('NewTest'));
        self::assertEquals('NewTest', $this->element->getL11n()->text);
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateElement
     * @group module
     */
    public function testLabelInputOutput() : void
    {
        $this->element->addLabel(new SurveyTemplateLabelL11n());
        self::assertCount(1, $this->element->getLabels());
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateElement
     * @group module
     */
    public function testValueInputOutput() : void
    {
        $this->element->addValue('testValue');
        self::assertCount(1, $this->element->getValues());
    }

    /**
     * @covers Modules\Surveys\Models\SurveyTemplateElement
     * @group module
     */
    public function testSerialize() : void
    {
        $this->element->isOptional       = true;
        $this->element->order            = 3;
        $this->element->template         = 2;

        $serialized = $this->element->jsonSerialize();

        self::assertEquals(
            [
                'id'               => 0,
                'type'             => SurveyElementType::CHECKBOX,
                'isOptional'       => true,
                'order'            => 3,
                'template'         => 2,
                'labels'           => [],
                'values'           => [],
            ],
            $serialized
        );
    }
}
