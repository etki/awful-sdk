<?php

namespace Etki\AwfulSDK\IO;

use Etki\AwfulSDK\Exception\InvalidArgumentException;

/**
 * This class handles all verbosity-related tasks.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\IO
 * @author  Etki <etki@etki.name>
 */
class Verbosity
{
    /**
     * Mute verbosity level.
     *
     * @since 0.1.0
     */
    const LEVEL_MUTE = 'mute';
    /**
     * Emergency verbosity level.
     *
     * @since 0.1.0
     */
    const LEVEL_EMERGENCY = 'emergency';
    /**
     * Alert verbosity level.
     *
     * @since 0.1.0
     */
    const LEVEL_ALERT = 'alert';
    /**
     * Critical verbosity level.
     *
     * @since 0.1.0
     */
    const LEVEL_CRITICAL = 'critical';
    /**
     * Error verbosity level.
     *
     * @since 0.1.0
     */
    const LEVEL_ERROR = 'error';
    /**
     * Warning verbosity level.
     *
     * @since 0.1.0
     */
    const LEVEL_WARNING = 'warning';
    /**
     * Notice verbosity level.
     *
     * @since 0.1.0
     */
    const LEVEL_NOTICE = 'notice';
    /**
     * Info verbosity level.
     *
     * @since 0.1.0
     */
    const LEVEL_INFO = 'info';
    /**
     * Debug verbosity level.
     *
     * @since 0.1.0
     */
    const LEVEL_DEBUG = 'debug';

    private static $severity = array(
        self::LEVEL_MUTE => 9,
        self::LEVEL_DEBUG => 8,
        self::LEVEL_EMERGENCY => 7,
        self::LEVEL_ALERT => 6,
        self::LEVEL_CRITICAL => 5,
        self::LEVEL_ERROR => 4,
        self::LEVEL_WARNING => 3,
        self::LEVEL_NOTICE => 2,
        self::LEVEL_INFO => 1,
        self::LEVEL_DEBUG => 0,
    );

    /**
     * Compares two levels and returns integer according to `usort()` callback
     * rules.
     *
     * @param string $levelA Level to compare.
     * @param string $levelB Level to be compared with.
     *
     * @return int Integer lesser than zero if `$levelA` is lesser than
     * `$levelB`, 0 if they are equal, integer more than zero otherwise.
     * @since 0.1.0
     */
    public static function compareLevels($levelA, $levelB)
    {
        static::assertLevelExists($levelA);
        static::assertLevelExists($levelB);
        if ($levelA === $levelB) {
            return 0;
        }
        $severityA = static::$severity[$levelA];
        $severityB = static::$severity[$levelB];
        return $severityA - $severityB;
    }

    /**
     * Reports if corresponding verbosity level exists.
     *
     * @param string $level Level to check.
     *
     * @return bool
     * @since 0.1.0
     */
    public static function levelExists($level)
    {
        return isset(static::$severity[$level]);
    }

    /**
     * Verifies that provided level is a valid verbosity level.
     *
     * @param string|mixed $level Level to check.
     *
     * @throws InvalidArgumentException Thrown if such level doesn't exist.
     *
     * @return void
     * @since 0.1.0
     */
    private static function assertLevelExists($level)
    {
        if (!static::levelExists($level)) {
            $replacement = is_string($level) ? $level : gettype($level);
            $message = sprintf(
                'Invalid value (`%s`) provided as verbosity level',
                $replacement
            );
            throw new InvalidArgumentException($message);
        }
    }
}
