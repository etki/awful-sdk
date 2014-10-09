<?php
namespace Etki\AwfulSDK\Console;

use Etki\AwfulSDK\Console\IO\SymfonyIOAdapter;
use Etki\AwfulSDK\Task\TaskInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Basic command.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Console
 * @author  Etki <etki@etki.name>
 */
class AbstractBaseCommand extends Command
{
    /**
     * Related task.
     *
     * @type TaskInterface
     * @since 0.1.0
     */
    protected $task;

    /**
     * Initializes task I\O controller.
     *
     * @param InputInterface  $input  Symfony input controller.
     * @param OutputInterface $output Symfony output controller.
     *
     * @return void
     * @since 0.1.0
     */
    protected function initialize(
        InputInterface $input,
        OutputInterface $output
    ) {
        $ioc = new SymfonyIOAdapter($this->getApplication(), $input, $output);
        $this->task->setIO($ioc);
    }

    /**
     *
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     * @since 0.1.0
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $options = array_merge($input->getArguments(), $input->getOptions());
        if (isset($options['dry-run']) && $options['dry-run']) {
            $this->task->setDryRun(true);
            $message = '<comment>Performing dry run. That\'s what will ' .
                'happen on a regular run:</comment>';
            $output->writeln($message);
            $output->write(PHP_EOL);
        }
        return $this->task->execute($options);
    }
}
