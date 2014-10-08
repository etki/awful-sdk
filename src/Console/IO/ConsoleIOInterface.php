<?php
namespace Etki\AwfulSDK\Console\IO;

/**
 * Describes unified interface required by AwfulSDK's tasks.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Console\IO
 * @author  Etki <etki@etki.name>
 */
interface ConsoleIOInterface
{
    /**
     * Writes several lines at once.
     *
     * @param string[] $messages Messages to be written.
     *
     * @return void
     * @since 0.1.0
     */
    public function writeLines(array $messages);

    /**
     * Writes message without necessary terminating newline.
     *
     * @param null|string $message Message to write or null to insert only
     *                             linefeed symbol.
     * @param mixed       $args    Additional arguments to format the message in
     *                             `sprintf()` way.
     *
     * @return void
     * @since 0.1.0
     */
    public function writeLine($message = null, $args = null);

    /**
     * Writes new message.
     *
     * @param string $message Message to be written to stdout.
     * @param mixed  $args    Additional arguments to format the message in
     *                        `sprintf()` way.
     *
     * @return void
     * @since 0.1.0
     */
    public function write($message, $args = null);

    /**
     * Asks user for input.
     *
     * @param string $question Question to ask.
     * @param mixed  $default  Default value.
     * @param array  $options  List of possible options
     *
     * @return mixed Resolved value.
     * @since 0.1.0
     */
    public function ask($question, $default = null, $options = null);

    /**
     * Sets new indent.
     *
     * @param string $indent New indentation in spaces.
     *
     * @return void
     * @since 0.1.0
     */
    public function setIndent($indent);

    /**
     * Returns current indent.
     *
     * @return int Current indent.
     * @since 0.1.0
     */
    public function getIndent();

    /**
     * Increases indent by `$increment`.
     *
     * @param int $increment Amount of indentation to add.
     *
     * @return int Current indent.
     * @since 0.1.0
     */
    public function increaseIndent($increment);

    /**
     * Decreases indent by provided value.
     *
     * @param int $decrement Decrement.
     *
     * @return int Current indent.
     * @since 0.1.0
     */
    public function decreaseIndent($decrement);

    /**
     * Sets new line prefix.
     *
     * @param string|callable $prefix String to prepend every line or a callable
     *                                whose result will be prepended to every
     *                                line.
     *
     * @return void
     * @since 0.1.0
     */
    public function setLinePrefix($prefix);

    /**
     * Returns line prefix.
     *
     * @return string|callable String prefix or callable used to generate it.
     * @since 0.1.0
     */
    public function getLinePrefix();

    /**
     * Completely mutes all output.
     *
     * @return void
     * @since 0.1.0
     */
    public function mute();

    /**
     * Allows talking again
     *
     * @return void
     * @since 0.1.0
     */
    public function unMute();

    /**
     * Tells if I\O controller is muted.
     *
     * @return bool
     * @since 0.1.0
     */
    public function isMuted();
}
