<?php

namespace Anso\Framework\Console\Test;

use Anso\Framework\Base\Container;
use Anso\Framework\Base\Configuration;
use Anso\Framework\Console\Contract\IOManager;
use Anso\Framework\Base\Contract\Application;
use PHPUnit\Framework\TestCase;

abstract class ConsoleTestCase extends TestCase
{
    protected Application $application;
    protected IOManagerMock $ioManager;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        if (!defined('BASE_PATH')) {
            define('BASE_PATH', __DIR__ . "/../../../../../");
        }

        $configuration = new Configuration('/config/console');
        $container = new Container($configuration);

        $this->application = $container->make(Application::class);
        $this->application->singleton(IOManager::class, IOManagerMock::class);

        $this->ioManager = $container->make(IOManager::class);
    }

    protected function findExpected(string $expected): string
    {
        return str_replace(["\n", '~'], "", strstr($this->getActualOutput(), $expected));
    }
}