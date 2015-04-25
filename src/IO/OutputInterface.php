<?php

namespace Etki\AwfulSDK\IO;

/**
 * This is basic I\O interface that is used by Awful SDK components.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\IO
 * @author  Etki <etki@etki.name>
 */
interface OutputInterface
{
    /**
     * Sets verbosity level.
     *
     * @param string $verbosityLevel Verbosity level to set.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function setVerbosityLevel($verbosityLevel);

    /**
     * Writes `$message` to output.
     *
     * @param string $message        Message to write.
     * @param string $verbosityLevel Message verbosity level.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function write($message, $verbosityLevel = Verbosity::LEVEL_NOTICE);

    /**
     * Writes single line to output.
     *
     * @param string $message        Message to write.
     * @param string $verbosityLevel Message verbosity level.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function writeLine(
        $message = '',
        $verbosityLevel = Verbosity::LEVEL_NOTICE
    );

    /**
     * Outputs list of messages at once, each as a separate line,
     *
     * @param string[] $messages       List of messages to output.
     * @param string   $verbosityLevel Messages verbosity level.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function writeLines(
        array $messages,
        $verbosityLevel = Verbosity::LEVEL_NOTICE
    );
}
