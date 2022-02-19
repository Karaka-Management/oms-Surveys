<?php
/**
 * Karaka
 *
 * PHP Version 8.0
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\Surveys\tests\Models;

use Modules\Surveys\Models\NullSurveyTemplate;

/**
 * @internal
 */
final class NullSurveyTemplateTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\Surveys\Models\NullSurveyTemplate
     * @group framework
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\Surveys\Models\SurveyTemplate', new NullSurveyTemplate());
    }

    /**
     * @covers Modules\Surveys\Models\NullSurveyTemplate
     * @group framework
     */
    public function testId() : void
    {
        $null = new NullSurveyTemplate(2);
        self::assertEquals(2, $null->getId());
    }
}
