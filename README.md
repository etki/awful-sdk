# Awful SDK

This package was created with a single purpose - to make worst development ever
just awful. Wordpress, Opencart and buddies are welcome here to improve their
life a little bit more.

# Install

```bash
composer require etki/awful-sdk:*
```

You weren't expecting anything else, were you?

# Usage

## Merging

Merge directory tree A into directory tree B (hi there, Opencart).

**CLI:**

```bash
vendor/bin/wsdk merge ~/projects/opencart-module /var/www/opencart
```

**API:**

```php
use Etki\AwfulSDK\Task\Filesystem\Merge as MergeTask;
$task = new MergeTask; // will automatically create muted I\O controller.
$args = array(
    'source' => '~/projects/opencart-module',
    'target' => '/var/www/opencart'
    'extensions' => array('php', 
);
$task->run($args);
```

## Cleaning

Cleans directory

**CLI:**

```bash
vendor/bin/asdk clean opencart/cache
```

**API:**

```php
use Etki\AwfulSDK\Task\Filesystem\Clean as CleanTask;
$task = new CleanTask;
$args = array(
    'target' => array('opencart/cache', 'opencart/system/cache'),
    'extensions' => array('*'), // default value
);
$task->run($args);
```

(Subcommand) Clean up composer installation

```bash
vendor/bin/asdk clean:installation --vendor-dir=vendor --bin-dir=bin \
    --directory=relative/path --add-dir=opencart
```

## Build?

```bash
vendor/bin/asdk build source --config=config/build.yml
```

## Generate command

```bash
vendor/bin/asdk generate-command --command-dir=commands --task-dir=tasks namespace:name
```

## Install server configuration

```bash
vendor/bin/asdk install:server apache --directory=public --template=default
```

## Create database

```bash
vendor/bin/asdk install:database wordpress --server=mysql --config=path/to/config
```

## Install assets

```bash
vendor/bin/asdk install:assets --target-dir=public/assets --config=path/to/config
```