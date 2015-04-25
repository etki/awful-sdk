<?php

namespace Etki\AwfulSDK\Tests\Support;

use Codeception\TestCase\Test as CodeceptionTest;
use ReflectionClass;

/**
 * Base test class.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Tests\Support
 * @author  Etki <etki@etki.name>
 */
abstract class Test extends CodeceptionTest
{
    /**
     * Retrieves tested class FQCN.
     *
     * @return string
     * @since 0.1.0
     */
    abstract public function getTestedClassName();

    /**
     * Creates test instance.
     *
     * @return object
     * @since 0.1.0
     */
    protected function createTestInstance()
    {
        $reflection = new ReflectionClass($this->getTestedClassName());
        return $reflection->newInstanceArgs(func_get_args());
    }
}
