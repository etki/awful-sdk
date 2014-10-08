<?php
namespace Etki\AwfulSDK\Task;

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
    public function setDryRun($dryRun);
    public function isDryRunEnabled();
    public function execute(array $options);
}
