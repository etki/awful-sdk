<?php

namespace Etki\AwfulSDK\IO\Writer;

use Etki\AwfulSDK\IO\WriterInterface;

/**
 * Writes provided messages to resource, e.g. file or stdout.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\IO\Writer
 * @author  Etki <etki@etki.name>
 */
class StreamWriter implements WriterInterface
{
    /**
     * Resource to write into.
     *
     * @type resource
     * @since 0.1.0
     */
    private $resource;

    /**
     * Initializer.
     *
     * @param resource $resource Resource to write into.
     *
     * @return self
     * @since 0.1.0
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Writes message.
     *
     * @param string $message Message to write.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function write($message)
    {
        fwrite($this->resource, $message);
        return $this;
    }
}
