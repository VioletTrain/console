<?php

namespace Anso\Framework\Console\Test;

use Anso\Framework\Console\Contract\IOManager;
use Anso\Framework\Console\Exception\InvalidFormatException;

class IOManagerMock implements IOManager
{
    private array $commands;

    public function readLine($prompt = ''): string
    {
        $value = array_shift($this->commands) ?? 'exit';

        return $value;
    }

    public function writeLine(string $output): void
    {
        echo $this->newLine() . $output . $this->newLine() . $this->newLine();
    }

    /**
     * @param string $integerName
     * @return int
     * @throws InvalidFormatException
     */
    public function readInteger(string $integerName): int
    {
        $integer = array_shift($this->commands) ?? null;

        if (!is_numeric($integer)) {
            throw new InvalidFormatException('numeric');
        }

        return $integer;
    }

    public function pushCommand(string $command): IOManagerMock
    {
        $this->commands[] = $command;

        return $this;
    }

    public function newLine(): string
    {
        return "\n";
    }
}