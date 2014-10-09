# Concepts

The main purpose of AwfulSDK is to serve end developer with set of console
commands for common tasks, so they can be easily used by hand or in script.
However, that wouldn't be good enough for me, so everything has been pushed a
little bit further than just console commands.

AwfulSDK is based not on *commands*, but *tasks*. Every task represents single
action - merging, database dumping, database restoring, giving a hug - and
doesn't give a fuxrun about outer world. The only thing that binds task to outer
world is *I\O controller* that puts messages onto console an asks for user
input. This I\O controller is passed on task construction or later via `setIO()`
method, but whenever task is executed without an I\O controller, dummy one
(little muted black-hole controller) will be created. The commands, like
goggles, do actually nothing but call tasks and put "this is a dry run"
notification on screen.
 
The point of this architecture is that tasks are decoupled from environment, and
can be used both in Symfony-based console commands and Composer scripts in a
snap, just don't forget to feed correct IOAdapter to them. You can declare this
SDK as dependency in any package, and then use those tasks in any order or way
you would like; even if you're not using Symfony/Console or Composer to
drive your scripts, you still can implement your own I\O adapter using
`Etki\AwfulSDK\Console\IO\ConsoleIOInterface` and power up tasks using that
adapter. Come on, i even told you don't need adapter at all if you're ok with
blank output.

So, you can not only run commands from CLI, but integrate tasks in your package.
Hell, you can integrate commands too: just extend one of the commands and
overload `argumentDefinitions()` and `processArguments()` methods to implement
your own logic regarding arguments defaults or processing.