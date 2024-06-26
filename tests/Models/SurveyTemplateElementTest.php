<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
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
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\Surveys\Models\SurveyTemplateElement::class)]
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

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        self::assertEquals(0, $this->element->id);

        $date = new \DateTime('now');
        self::assertEquals([], $this->element->getLabels());
        self::assertEquals([], $this->element->getValues());
        self::assertInstanceOf('\Modules\Surveys\Models\SurveyTemplateElementL11n', $this->element->getL11n());
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testL11nInputOutput() : void
    {
        $this->element->setL11n(new SurveyTemplateElementL11n('NewTest'));
        self::assertEquals('NewTest', $this->element->getL11n()->text);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testLabelInputOutput() : void
    {
        $this->element->addLabel(new SurveyTemplateLabelL11n());
        self::assertCount(1, $this->element->getLabels());
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testValueInputOutput() : void
    {
        $this->element->addValue('testValue');
        self::assertCount(1, $this->element->getValues());
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testSerialize() : void
    {
        $this->element->isOptional = true;
        $this->element->order      = 3;
        $this->element->template   = 2;

        $serialized = $this->element->jsonSerialize();

        self::assertEquals(
            [
                'id'         => 0,
                'type'       => SurveyElementType::CHECKBOX,
                'isOptional' => true,
                'order'      => 3,
                'template'   => 2,
                'labels'     => [],
                'values'     => [],
            ],
            $serialized
        );
    }
}
