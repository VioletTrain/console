<?php

namespace Anso\Framework\Console;

use Anso\Framework\Console\Exception\CommandNotFoundException;
use Anso\Framework\Base\Configuration;
use Anso\Framework\Base\Contract\Container;
use Anso\Framework\Console\Contract\Command;
use Throwable;

class FrontController
{
    protected Container $container;
    protected Configuration $configuration;
    protected CommandCollection $commands;

    public function __construct(Container $container, Configuration $configuration)
    {
        $this->container = $container;
        $this->configuration = $configuration;
        $this->loadCommands();
    }

    protected function loadCommands()
    {
        $this->commands = include($this->configuration->configPath() . '/commands.php');
    }

    /**
     * @param Command $command
     * @return string
     * @throws Throwable
     */
    public function handle(Command $command): string
    {
        if (!$commandHandler = $this->commands->findCommand($command->name())) {
            throw new CommandNotFoundException($command->name());
        }

        if (in_array('help', $command->parameters())) {
            return $commandHandler::description();
        }

        $commandHandler = $this->container->make($commandHandler);

        return $commandHandler->handle(new ParameterBag($command->parameters()));
    }
}