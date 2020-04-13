<?php

namespace Anso\Framework\Console;

use Anso\Framework\Base\BaseApp;
use Anso\Framework\Console\Contract\IOManager;
use Anso\Framework\Base\Contract\ExceptionHandler;
use Throwable;

class ConsoleApp extends BaseApp
{
    private ExceptionHandler $exceptionHandler;
    private FrontController $frontController;
    private CommandParser $commandParser;
    private IOManager $ioManager;
    private bool $started;

    public function start(): void
    {
        $this->started = true;
        $this->exceptionHandler = $this->configuration->exceptionHandler();

        try {
            $this->frontController = $this->container->make(FrontController::class);
            $this->commandParser = $this->container->make(CommandParser::class);
            $this->ioManager = $this->container->make(IOManager::class);
        } catch (Throwable $e) {
            $this->exceptionHandler->handle($e);
        }

        $this->ioManager->writeLine("Hello there. Type 'help' to list available commands.\n");

        while ($this->started) {
            $input = $this->ioManager->readLine();

            try {
                $command = $this->commandParser->parse($input);
                $output = $this->frontController->handle($command);
            } catch (Throwable $e) {
                $this->exceptionHandler->handle($e);
                continue;
            }

            $this->ioManager->writeLine($output);
        }
    }

    public function stop(): void
    {
        $this->started = false;
    }
}