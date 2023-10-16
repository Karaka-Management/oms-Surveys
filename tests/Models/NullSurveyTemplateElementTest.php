<?php
/**
 * Jingga
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

use Modules\Surveys\Models\NullSurveyTemplateElement;

/**
 * @internal
 */
final class NullSurveyTemplateElementTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Surveys\Models\NullSurveyTemplateElement
     * @group module
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Surveys\Models\SurveyTemplateElement', new NullSurveyTemplateElement());
    }

    /**
     * @covers Modules\Surveys\Models\NullSurveyTemplateElement
     * @group module
     */
    public function testId() : void
    {
        $null = new NullSurveyTemplateElement(2);
        self::assertEquals(2, $null->id);
    }

    /**
     * @covers Modules\Surveys\Models\NullSurveyTemplateElement
     * @group module
     */
    public function testJsonSerialize() : void
    {
        $null = new NullSurveyTemplateElement(2);
        self::assertEquals(['id' => 2], $null);
    }
}
