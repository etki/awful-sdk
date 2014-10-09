<?php
namespace Etki\AwfulSDK\Task;

use Etki\AwfulSDK\Console\IO\ConsoleIOInterface;

/**
 * Basic task interface.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Console
 * @author  Etki <etki@etki.name>
 */
interface TaskInterface
{
    /**
     * Enables or disables dry run.
     *
     * @param bool $dryRun Dry run.
     *
     * @return void
     * @since 0.1.0
     */
    public function setDryRun($dryRun);

    /**
     * Tells if task dry run mode is on.
     *
     * @return bool
     * @since 0.1.0
     */
    public function isDryRunEnabled();

    /**
     * Executes task.
     *
     * @param array $options Additional options to run.
     *
     * @return int Exit code.
     * @since 0.1.0
     */
    public function execute(array $options);

    /**
     * Sets I\O controller.
     *
     * @param ConsoleIOInterface $ioc
     *
     * @return void
     * @since 0.1.0
     */
    public function setIO(ConsoleIOInterface $ioc);

    /**
     *
     *
     * @param int $verbosityLevel
     *
     * @return
     * @since 0.1.0
     */
    public function setVerbosity($verbosityLevel);
}
