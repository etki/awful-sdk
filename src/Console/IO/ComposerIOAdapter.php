<?php
namespace Etki\AwfulSDK\Console\IO;

use Composer\IO\IOInterface;

/**
 * Simple adapter for Composer I\O controller.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Console\IO
 * @author  Etki <etki@etki.name>
 */
class ComposerIOAdapter extends AbstractConsoleIOAdapter
{
    /**
     * Composer I\O controller.
     *
     * @type IOInterface
     * @since 0.1.0
     */
    protected $ioc;

    /**
     * @param IOInterface $ioc
     *
     * @return self
     */
    public function __construct(IOInterface $ioc)
    {
        $this->ioc = $ioc;
    }

    /**
     * Writes single line.
     *
     * @param string $message Message to be written.
     * @param mixed  $args    Additional arguments to format the message.
     *
     * @return void
     * @since 0.1.0
     */
    public function writeLine($message = null, $args = null)
    {
        if ($this->muted) {
            return;
        }
        $message = $message ? $this->formatMessage($message, $args) : '';
        $this->ioc->write($message);
        $this->endedWithNewline = true;
    }

    /**
     * Writes provided message.
     *
     * @param string $message Message to be displayed.
     * @param mixed  $args    Additional arguments to format the message.
     *
     * @return void
     * @since 0.1.0
     */
    public function write($message, $args = null)
    {
        if ($this->muted) {
            return;
        }
        $this->ioc->write($this->formatMessage($message, $args), false);
        $pos = strrpos($message, PHP_EOL);
        $length = strlen($message);
        $this->endedWithNewline = $pos === $length - strlen(PHP_EOL);
    }

    /**
     * Asks user a question and returns user input.
     *
     * @param string $question Question to ask.
     * @param mixed  $default  Default value,
     * @param array  $options  List of choices.
     *
     * @todo not even started.
     *
     * @return mixed
     * @since 0.1.0
     */
    public function ask($question, $default = null, $options = null)
    {
        if ($this->muted) {
            return $default;
        }
        throw new \RuntimeException('Not yet implemented');
    }
}
