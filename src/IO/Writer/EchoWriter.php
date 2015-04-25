<?php

namespace Etki\AwfulSDK\IO\Writer;

use Etki\AwfulSDK\IO\WriterInterface;

/**
 * Simplest writer possible.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\IO\Writer
 * @author  Etki <etki@etki.name>
 */
class EchoWriter implements WriterInterface
{
    /**
     * Simply spits out message wherever echo is going to spit it.
     *
     * @param string $message Message to write.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function write($message)
    {
        echo $message;
        return $this;
    }
}
