## Console framework for a training project.

## Installation

[anso/console](https://github.com/VioletTrain/console) can be installed via [Composer](https://getcomposer.org).

```bash
composer require anso/console:dev-master
```

## Usage

A few configuration files must be created and placed in a single folder before instantiating __Application__ object 
and calling __start()__ method:

- exception_handler.php - must return instance of
[ExceptionHandler](https://github.com/VioletTrain/contract/blob/master/src/ExceptionHandler.php)
- providers.php - must return array of
[Providers](https://github.com/VioletTrain/contract/blob/master/src/Provider.php)
that are used to register DI container's bindings.
- commands.php - must return instance of 
[CommandCollection](https://github.com/VioletTrain/console/blob/master/src/CommandCollection.php).
It contains array of commands defined by key as name and string value as 
[Handler](https://github.com/VioletTrain/console/blob/master/src/Contract/CommandHandler.php)

Afterwards application can be started like this (/public/index.php):

```php
<?php

define('BASE_PATH', __DIR__);

require __DIR__ . '/vendor/autoload.php';

use Anso\Framework\Base\Container;
use Anso\Framework\Base\Configuration;
use Anso\Framework\Console\ConsoleApp;
use Anso\Framework\Contract\Application;

$configuration = new Configuration('/config/console');
$container = new Container($configuration);
$app = new ConsoleApp($container, $configuration);

$container->addResolved(Application::class, $app);

$app->start();
```

- BASE_PATH constant is needed to include config files and extract values from them later.
- To enable autoloading composer's autoload.php must be required.
- Then 
[Configuration](https://github.com/VioletTrain/base/blob/master/src/Configuration.php), 
[Container](https://github.com/VioletTrain/base/blob/master/src/Container.php) 
and 
[ConsoleApp](https://github.com/VioletTrain/console/blob/master/src/ConsoleApp.php)
objects must be created. Be sure that you have 
[Application](https://github.com/VioletTrain/contract/blob/master/src/Application.php), 
[Container](https://github.com/VioletTrain/contract/blob/master/src/Container.php)
and 
[Configuration](https://github.com/VioletTrain/base/blob/master/src/Configuration.php)
registered as singletons either in a provider or right after creating $app object.
- $app object should be marked as resolved, so that if it is required later, a duplicate app object with wrong config wouldn't be created.
- Finally the app can start working.
