<?php
namespace Etki\AwfulSDK\Console\IO;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Adapts symfony console setup to unified interface.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Console\IO
 * @author  Etki <etki@etki.name>
 */
class SymfonyIOAdapter extends AbstractConsoleIOAdapter
{
    /**
     * Input instance.
     *
     * @type InputInterface
     * @since 0.1.0
     */
    protected $input;
    /**
     * Output instance.
     *
     * @type OutputInterface
     * @since 0.1.0
     */
    protected $output;
    /**
     * Application instance.
     *
     * @type Application
     * @since 0.1.0
     */
    protected $application;

    /**
     * Constructs new instance.
     *
     * @param Application     $application Symfony console application instance.
     * @param InputInterface  $input       Symfony console input.
     * @param OutputInterface $output      Symfony console output.
     *
     * @return self
     * @since 0.1.0
     */
    public function __construct(
        Application $application,
        InputInterface $input,
        OutputInterface $output
    ) {
        $this->application = $application;
        $this->input = $input;
        $this->output = $output;
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

    /**
     * Writes single line,
     *
     * @param null  $message Message to be written.
     * @param mixed $args    Arguments to format the message.
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
        $this->output->writeln($message);
        $this->endedWithNewline = true;
    }

    /**
     * Writes single message.
     *
     * @param string $message Message to be written.
     * @param mixed  $args    Additional arguments to format the message,
     *
     * @return void
     * @since 0.1.0
     */
    public function write($message, $args = null)
    {
        if ($this->muted) {
            return;
        }
        $this->output->write($this->formatMessage($message, $args));
        $pos = strrpos($message, PHP_EOL);
        $length = strlen($message);
        $this->endedWithNewline = $pos === $length - strlen(PHP_EOL);
    }
}
