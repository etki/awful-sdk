<?php
namespace Etki\AwfulSDK\Console\IO;

/**
 * A simple dummy I\O controller to serve as a black hole.
 *
 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Console\IO
 * @author  Etki <etki@etki.name>
 */
class Dummy implements ConsoleIOInterface
{
    public function setIndent($indent)
    {

    }
    public function getIndent()
    {
        return 0;
    }
    public function increaseIndent($increment)
    {
        return 0;
    }
    public function decreaseIndent($decrement)
    {
        return 0;
    }
    public function mute()
    {

    }
    public function unMute()
    {

    }
    public function isMuted()
    {
        return false;
    }
    public function setLinePrefix($linePrefix)
    {

    }
    public function getLinePrefix()
    {
        return '';
    }
    public function write($message, $args = null)
    {

    }
    public function writeLine($message = null, $args = null)
    {

    }
    public function writeLines(array $messages)
    {

    }
    public function ask($question, $defaultValue = null, $options = null)
    {

    }
}
