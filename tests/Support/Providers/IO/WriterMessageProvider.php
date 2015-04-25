<?php

namespace Etki\AwfulSDK\Tests\Support\Providers\IO;

use Etki\AwfulSDK\Tests\Support\Providers\ArrayWrapper;

/**
 * This class provides test data for writers.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Tests\Support\Providers\IO
 * @author  Etki <etki@etki.name>
 */
class WriterMessageProvider extends ArrayWrapper
{
    /**
     * Initializer.
     *
     * @return self
     * @since 0.1.0
     */
    public function __construct()
    {
        $data = array(
            array('',),
            array('test'),
            array('multiline' . PHP_EOL . 'text',),
        );
        $this->setData($data);
    }
}
