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

use Modules\Surveys\Models\SurveyStatus;
use Modules\Surveys\Models\SurveyTemplate;
use Modules\Surveys\Models\SurveyTemplateL11n;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\Surveys\Models\SurveyTemplate::class)]
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

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        self::assertEquals(0, $this->survey->id);

        $date = new \DateTime('now');
        self::assertEquals([], $this->survey->elements);
        self::assertEquals([], $this->survey->tags);
        self::assertEquals([], $this->survey->files);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testL11nInputOutput() : void
    {
        $this->survey->setL11n(new SurveyTemplateL11n('NewTest'));
        self::assertEquals('NewTest', $this->survey->getL11n()->title);
    }

    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testSerialize() : void
    {
        $this->survey->hasPublicResult = false;
        $this->survey->start           = new \DateTime('now');
        $this->survey->end             = new \DateTime('now');
        $this->survey->virtualPath     = 'test/path';

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
