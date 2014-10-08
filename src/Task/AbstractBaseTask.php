<?php

namespace Etki\AwfulSDK\Task;

use Etki\AwfulSDK\Console\IO\ConsoleIOInterface;
use Etki\AwfulSDK\Console\IO\Dummy;

/**
 * This class aggregates basic task functionality.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Console
 * @author  Etki <etki@etki.name>
 */
abstract class AbstractBaseTask implements TaskInterface
{
    /**
     * Whether perform a dry run or regular run.
     *
     * @type bool
     * @since 0.1.0
     */
    protected $dryRun = false;
    /**
     * Task start time.
     *
     * @type float
     * @since 0.1.0
     */
    protected $startTime;
    /**
     * Task end time.
     *
     * @type float
     * @since 0.1.0
     */
    protected $endTime;
    /**
     * I\O controller to communicate with outer world
     *
     * @type ConsoleIOInterface
     * @since 0.1.0
     */
    protected $ioc;

    /**
     * Sets up I\O controller.
     *
     * @param ConsoleIOInterface $consoleIO I\O controller.
     *
     * @return self
     * @since 0.1.0
     */
    public function __construct(ConsoleIOInterface $consoleIO = null)
    {
        $this->ioc = $consoleIO ? $consoleIO : new Dummy;
    }

    /**
     * Executes task.
     *
     * @param array $arguments Arguments required to run.
     *
     * @return int Exit code.
     * @since 0.1.0
     */
    public function execute(array $arguments)
    {
        $this->ioc->writeLine('Running task `%s`', $this->getName());
        $this->ioc->writeLine();
        $this->ioc->increaseIndent(2);
        if ($this->dryRun) {
            $exitCode = $this->dryRun($arguments);
        } else {
            $exitCode = $this->run($arguments);
        }
        $this->ioc->decreaseIndent(2);
        $this->ioc->writeLine();
        $this->ioc->writeLine(
            'Task `%s` has finished in `%.3f` seconds with %s.',
            $this->getName(),
            $this->endTime - $this->startTime,
            is_int($exitCode) ? 'exit code ' .$exitCode : 'no exit code'
        );
        return is_int($exitCode) ? $exitCode : 0;
    }

    /**
     * Calculates current task name.
     *
     * @return string Task name.
     * @since 0.1.0
     */
    public function getName()
    {
        $baseNamespace = __NAMESPACE__ . '\\Task\\';
        $relativeClassName = substr(get_class($this), strlen($baseNamespace));
        $temp = str_replace('\\', ':', $relativeClassName);
        $temp = preg_replace('(?<!:)([A-Z])', '-$1', $temp);
        return strtolower($temp);
    }

    /**
     * Runs task.
     *
     * @return int|void Exit code or nothing.
     * @since 0.1.0
     */
    abstract public function run();

    /**
     * Performs dry run.
     *
     * @return int|void Exit code or nothing. Since task can fail on arguments
     *                  validation, don't be so sure it always will be zero.
     * @since 0.1.0
     */
    abstract public function dryRun();
}
