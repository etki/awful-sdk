<?php
namespace Etki\AwfulSDK\Console\IO;

/**
 * This class holds basic functionality required by adapter realizations.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Console\IO
 * @author  Etki <etki@etki.name>
 */
abstract class AbstractConsoleIOAdapter implements ConsoleIOInterface
{
    /**
     * Tells if last message has ended with newline.
     *
     * @type bool
     * @since 0.1.0
     */
    protected $endedWithNewline = true;
    /**
     * Indentation level (in spaces).
     *
     * @type int
     * @since 0.1.0
     */
    protected $indent = 0;
    /**
     * Prefix that will be prepended to every line. If callable is set as
     * prefix, it will be called once for every new line, and it's result will
     * be prepended to line in output.
     *
     * @type string|callable
     * @since 0.1.0
     */
    protected $linePrefix;
    /**
     * Tells if I\O controller is currently muted.
     *
     * @type bool
     * @since 0.1.0
     */
    protected $muted = false;

    /**
     * Sets indentation level.
     *
     * @param int $indent New indentation level.
     *
     * @return void
     * @since 0.1.0
     */
    public function setIndent($indent)
    {
        if ((int) $indent < 0) {
            $message = sprintf(
                'Invalid indentation provided (`%s`)',
                (string) $indent
            );
            throw new \InvalidArgumentException($message);
        }
        $this->indent = (int) $indent;
    }

    /**
     * Returns indentation level.
     *
     * @return int
     * @since 0.1.0
     */
    public function getIndent()
    {
        return $this->indent;
    }

    /**
     * {@inheritdoc}
     *
     * @param int $increment Indentation increment.
     *
     * @return int Resulting indentation.
     * @since 0.1.0
     */
    public function increaseIndent($increment)
    {
        return $this->indent += $increment;
    }

    /**
     * {@inheritdoc}
     *
     * @param int $decrement Decrement
     *
     * @return int Resulting indentation.
     * @since 0.1.0
     */
    public function decreaseIndent($decrement)
    {
        return $this->indent = max($this->indent - $decrement, 0);
    }

    /**
     * {@inheritdoc}
     *
     * @param callable|string $prefix New line prefix.
     *
     * @return void
     * @since 0.1.0
     */
    public function setLinePrefix($prefix)
    {
        $this->linePrefix = $prefix;
    }

    /**
     * {@inheritdoc}
     *
     * @return callable|string Current line prefix.
     * @since 0.1.0
     */
    public function getLinePrefix()
    {
        return $this->linePrefix;
    }

    /**
     * Formats message with indent, line prefix and additional arguments.
     *
     * @param string $message Message to be formatted.
     * @param mixed  $args    Additional arguments to format the message.
     *
     * @return string Formatted message.
     * @since 0.1.0
     */
    protected function formatMessage($message, $args = null)
    {
        if (!trim($message)) {
            return $message;
        }
        if ($args) {
            if (!is_array($args)) {
                $args = array($args);
            }
            $message = vsprintf($message, $args);
        }
        $prefix = '';
        if ($this->linePrefix) {
            if (is_callable($this->linePrefix)) {
                $prefix = call_user_func($this->linePrefix);
            } else {
                $prefix = $this->linePrefix;
            }
        }
        if ($this->indent) {
            $prefix = str_repeat(' ', $this->indent);
        }
        return $prefix . $message;
    }

    /**
     * Writes several lines at once.
     *
     * @param string[] $messages Messages to be written.
     *
     * @return void
     * @since 0.1.0
     */
    public function writeLines(array $messages)
    {
        if ($this->muted) {
            return;
        }
        foreach ($messages as $message) {
            $lines = explode(PHP_EOL, $message);
            foreach ($lines as $line) {
                $this->writeLine($line);
            }
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     * @since 0.1.0
     */
    public function mute()
    {
        $this->muted = true;
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     * @since 0.1.0
     */
    public function unMute()
    {
        $this->muted = false;
    }

    /**
     * {@inheritdoc}
     *
     * @return bool
     * @since 0.1.0
     */
    public function isMuted()
    {
        return $this->muted;
    }
}
