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

use Modules\Surveys\Models\NullSurveyTemplateLabelL11n;

/**
 * @internal
 */
final class Null extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Surveys\Models\NullSurveyTemplateLabelL11n
     * @group framework
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Surveys\Models\SurveyTemplateLabelL11n', new NullSurveyTemplateLabelL11n());
    }

    /**
     * @covers Modules\Surveys\Models\NullSurveyTemplateLabelL11n
     * @group framework
     */
    public function testId() : void
    {
        $null = new NullSurveyTemplateLabelL11n(2);
        self::assertEquals(2, $null->getId());
    }
}
