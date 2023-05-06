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

use Modules\Surveys\Models\NullSurveyTemplateLabelL11n;

/**
 * @internal
 */
final class NullSurveyTemplateLabelL11nTest extends \PHPUnit\Framework\TestCase
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
        self::assertEquals(2, $null->id);
    }
}
