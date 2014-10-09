&gt;&gt;&gt; WIP, please check back later

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

By default, AwfulSDK will look for file `asdk.yml` in current working directory
to use it as configuration file; however, you can easily specify any other file.
Fuxrun, in most cases you won't need any configuration at all.

## Standard options

* `--dry-run` - quite self-explanatory, will just print everything it's gonna do
instead of real work (if you still don't get it, just imagine Kim Jong Un).
* `-v|-vv|-vvv` - verbosity levels. Mostly not used.

## Merging

Merge directory tree A into directory tree B (hi there, Opencart).

**CLI:**

```bash
vendor/bin/wsdk merge ~/projects/opencart-module /var/www/opencart \
--keep=/var/www/opencart/config.php --keep=/var/www/opencart/admin/config.php
--use-symlinks
```

**API:**

```php
use Etki\AwfulSDK\Task\Filesystem\Merge as MergeTask;
$task = new MergeTask; // will automatically create muted I\O controller.
$args = array(
    'source' => '~/projects/opencart-module',
    'target' => '/var/www/opencart'
    'extensions' => ['php'], // optional
    'keep' => [ // optional
        '/var/www/opencart/config.php',
        '/var/www/opencart/admin/config.php',
    ],
    'use-symlinks' => true,
);
$task->run($args);
```

## Cleaning

Cleans target directory.

**CLI:**

```bash
vendor/bin/asdk clean opencart/cache
```

**API:**

```php
use Etki\AwfulSDK\Task\Filesystem\Clean as CleanTask;

$task = new CleanTask;
$args = [
    'target' => ['opencart/cache', 'opencart/system/cache'],
    'extensions' => ['*'], // default value
];
$task->run($args);
```

## Clean composer project of installed files.

Cleans up composer installation.

**CLI:**

```bash
vendor/bin/asdk clean:composer-project relative/path --vendor-dir=vendor \
    --bin-dir=bin --also=opencart --also="runtime/*" --reinstall \
    --composer=/usr/local/bin/composer
```

**API:**

```php
use Etki\AwfulSDK\Task\Clean\Composer as CleanComposerProjectTask;

$task = new CleanComposerProjectTask;
$args = [
    'directory' => getcwd(),              // optional, current directory is used
    'vendor-dir' => 'vendor',             // optional
    'bin-dir' => 'bin',                   // optional as well
    'also' => ['opencart', 'runtime/*',], // guess if that's optional too
    'reinstall' => true,                  // will try to reinstall everything
                                          // after deletion
    'composer' => 'composer.phar',        // path to composer executable
];
$task->execute();
```

## Pack

Creates package from directory. Don't worry bout messing up with original files,
a copy of target directory will be created in temporary dir, packed, and deleted
after package will be moved to target location.

**CLI:**

```bash
vendor/bin/asdk pack /var/www/project ~/backup.zip --resolve-symlinks \
    --exclude=cache/* --exclude=submodule
```

**API:**

```php
use Etki\AwfulSDK\Task\Pack as PackTask;

$task = new PackTask;
$args = [
    'source' => '/var/www/project',
    'target' => '~/backup.zip',
    'format' => 'zip', // unnecessary if zip/tar.gs extension is present
    'resolve-symlinks' => true, // will copy symlinked files/dirs in place of
                                // symlinks
    'exclude' => ['cache/*', 'submodule',],
];
$task->execute($args);
```

## Install server configuration

Creates new host in server config files. Assumes that
`/etc/%server-name%/sites-%status%` directory structure is used
(Debian-based distros). Most probably will require root access (sudo).

**CLI:**

```bash
sudo vendor/bin/asdk install:host example.host.org apache \
--document-root=public --template=default --port=80 --ssl
```

**API:**

```php
use Etki\AwfulSDK\Task\Install\Host as HostInstallTask;

$task = new HostInstallTask;
$args = [
    'host' => 'example.host.org', //
    'server' => 'apache2.2',      // default: nginx; apache is a synonym for apache2.4
    'document-root' => 'public',  // current working directory is used by default
    'template' => 'yii-1',        // template to use
    'port' => 80,
    'ssl' => true,
];
```

## Install assets

Fetches assets from around the globeweb and installs them in target directory.

This task is slightly smarter than just dumb: 

1. Assets are specified under 'assets' key in config. Each element is checked
if it's a string (destination) or another array (asset group).
2. If asset explicitly points to archive, it will be extracted to destination,
and destination will be treated as directory that might need to be created.
If archive contains single directory only, it's contents will extracted to
target directory (if everything in archive is grouped in single directory, it
will be simply disregarded).
3. If asset explicitly points to a file and it's destination has quite the same
extension, then asset will be installed under the very same name.
`%url%/jquery.min.js => jquery.js` will install asset as `jquery.js`, but
`%url%/jquery.min.js => style.css` will be treated as "install jquery.min.js
into style.css directory".

Grouping refers to goggles again - it does nothing but keeps configuration
clean.

```bash
vendor/bin/asdk install:assets public/assets --config=path/to/config.yml
```

```php
use Etki\AwfulSDK\Task\Install\Assets as AssetsInstallTask;

$task = new AssetsInstallTask;
$args = [
    'target-dir' => 'public/assets',
    'assets' => [ // if you specify assets directly, task won't even look for config file.
        'bootstrap' => [ // assets grouping. Just to keep your project logic clean.
            'https://github.com/twbs/bootstrap/releases/download/v3.2.0/bootstrap-3.2.0-dist.zip' =>
                'bootstrap/core',
            'http://fortawesome.github.io/Font-Awesome/assets/font-awesome-4.2.0.zip' =>
                'bootstrap/fa',
            'http://some.deep.host.org/custom-extension.css' => 'bootstrap/custom',
        ],
        'http://code.jquery.com/jquery-2.1.1.min.js' => 'jquery.js', // you didn't like my grouping? pff fine.
    ],
];
```


## Create database

Requires root database access.

```bash
vendor/bin/asdk db:create wordpress --server=mysql --config=path/to/config.yml
```

## Create database user

```bash
vendor/bin/asdk db:user:create wordpress --server=mysql --host=localhost \
    --config=path/to/config.yml
```

## Drop database user

```bash
vendor/bin/asdk db:user:drop wordpress --server=mysql --host=localhost \
    --config=path/to/config.yml
```

## Grant database access to user

```bash
vendor/bin/asdk db:grant-access wordpress wordpress@localhost \
    --config=/path/to/config.yml
```

## Dump database

```bash
vendor/bin/asdk db:dump data/dump.sql --config=path/to/config.yml
```

## Restore database

```bash
vendor/bin/asdk db:restore data/dump.sql --config=path/to/config.yml
```

# Help commands

```bash
vendor/bin/asdk help:install:host:list-templates
```

```bash
vendor/bin/asdk help:install:host:list-servers
```