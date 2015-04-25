<?php

namespace Etki\AwfulSDK\IO;

/**
 * Interface for writer. Simply writes something somewhere.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\IO\Writer
 * @author  Etki <etki@etki.name>
 */
interface WriterInterface
{
    /**
     * Writes message to wherever it should be written.
     *
     * @param string $message Message to write.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    public function write($message);
}
