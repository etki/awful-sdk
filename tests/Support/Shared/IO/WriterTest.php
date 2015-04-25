<?php

namespace Etki\AwfulSDK\Tests\Support\Shared\IO;

use Etki\AwfulSDK\IO\WriterInterface;
use Etki\AwfulSDK\Tests\Support\Test;
use Etki\AwfulSDK\Tests\Support\Providers\IO\WriterMessageProvider;

/**
 * Shared test for writer classes.
 *
 * @method WriterInterface createTestInstance()
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Tests\Support\Shared\IO
 * @author  Etki <etki@etki.name>
 */
abstract class WriterTest extends Test
{
    // data provides

    /**
     * Writer message provider.
     *
     * @return WriterMessageProvider
     * @since 0.1.0
     */
    public function messageProvider()
    {
        return new WriterMessageProvider;
    }
}
