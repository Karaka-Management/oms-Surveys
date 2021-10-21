<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Surveys\tests\Models;

use Modules\Surveys\Models\NullSurveyTemplateElementL11n;

/**
 * @internal
 */
final class NullSurveyTemplateElementL11nTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Surveys\Models\NullSurveyTemplateElementL11n
     * @group framework
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Surveys\Models\SurveyTemplateElementL11n', new NullSurveyTemplateElementL11n());
    }

    /**
     * @covers Modules\Surveys\Models\NullSurveyTemplateElementL11n
     * @group framework
     */
    public function testId() : void
    {
        $null = new NullSurveyTemplateElementL11n(2);
        self::assertEquals(2, $null->getId());
    }
}