<?php

namespace Etki\AwfulSDK\Tests\Unit\IO\Writer;

use Etki\AwfulSDK\Tests\Support\Shared\IO\WriterTest;

/**
 * Tests echo writer.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Tests\Unit\IO\Writer
 * @author  Etki <etki@etki.name>
 */
class EchoWriterTest extends WriterTest
{
    /**
     * Tested class FQCN.
     *
     * @since 0.1.0
     */
    const TESTED_CLASS = 'Etki\AwfulSDK\IO\Writer\EchoWriter';

    /**
     * {@inheritdoc}
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
     * Tests writing capabilities.
     *
     * @param string $message Message to write.
     *
     * @dataProvider messageProvider
     *
     * @return void
     * @since 0.1.0
     */
    public function testEchoWrite($message)
    {
        $this->expectOutputString($message);
        $this->createTestInstance()->write($message);
    }
}
