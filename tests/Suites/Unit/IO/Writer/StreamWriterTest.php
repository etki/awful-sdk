<?php

namespace Etki\AwfulSDK\Tests\Unit\IO\Writer;

use Etki\AwfulSDK\Tests\Support\Shared\IO\WriterTest;

class StreamWriterTest extends WriterTest
{
    /**
     * Tested class FQCN.
     *
     * @since 0.1.0
     */
    const TESTED_CLASS = 'Etki\AwfulSDK\IO\Writer\StreamWriter';

    /**
     * Returns tested class name.
     *
     * @return string
     * @since 0.1.0
     */
    public function getTestedClassName()
    {
        return self::TESTED_CLASS;
    }

    // tests

    /**
     * Tests writing message.
     *
     * @param string $message
     *
     * @dataProvider messageProvider
     *
     * @return void
     * @since 0.1.0
     */
    public function testStreamWrite($message)
    {
        $stream = fopen('php://temp', 'rw');
        $this->createTestInstance($stream)->write($message);
        fseek($stream, 0);
        $written = fread($stream, strlen($message) + 1);
        $this->assertSame($message, $written);
    }
}
