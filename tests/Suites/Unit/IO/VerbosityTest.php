<?php

namespace Etki\AwfulSDK\Tests\Unit\IO;

use Codeception\TestCase\Test;
use Etki\AwfulSDK\IO\Verbosity;

/**
 * Test for verbosity class.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Tests\Unit\IO
 * @author  Etki <etki@etki.name>
 */
class VerbosityTest extends Test
{
    const COMPARISON_RESULT_SMALLER = -1;
    const COMPARISON_RESULT_EQUAL = 0;
    const COMPARISON_RESULT_BIGGER = 1;

    // data providers

    /**
     * Provides samples for testing level comparison.
     *
     * @return array
     * @since 0.1.0
     */
    public function levelComparisonProvider()
    {
        return array(
            array(
                Verbosity::LEVEL_NOTICE,
                Verbosity::LEVEL_NOTICE,
                static::COMPARISON_RESULT_EQUAL,
            ),
            array(
                Verbosity::LEVEL_ALERT,
                Verbosity::LEVEL_DEBUG,
                static::COMPARISON_RESULT_BIGGER,
            ),
            array(
                Verbosity::LEVEL_INFO,
                Verbosity::LEVEL_CRITICAL,
                static::COMPARISON_RESULT_SMALLER,
            ),
        );
    }

    // tests

    /**
     * Tests level comparison.
     *
     * @param string $levelA         First verbosity level.
     * @param string $levelB         Second verbosity level.
     * @param int    $expectedResult Expected result.
     *
     * @dataProvider levelComparisonProvider
     *
     * @return void
     * @since 0.1.0
     */
    public function testLevelComparison($levelA, $levelB, $expectedResult)
    {
        $result = Verbosity::compareLevels($levelA, $levelB);
        // normalizing to -1 / 0 / 1
        $result = $result === 0 ? $result : $result / abs($result);
        $this->assertSame($expectedResult, $result);
    }
}
