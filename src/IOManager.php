<?php

namespace Anso\Framework\Console;

use Anso\Framework\Console\Contract\IOManager as IOManagerContract;
use Anso\Framework\Console\Exception\InvalidFormatException;

class IOManager implements IOManagerContract
{
    public function readLine($prompt = ''): string
    {
        return trim(readline($prompt . "\n > "));
    }

    public function writeLine(string $output): void
    {
        echo $this->newLine() . $output . $this->newLine();
    }

    /**
     * @param string $integerName
     * @return int
     * @throws InvalidFormatException
     */
    public function readInteger(string $integerName): int
    {
        $integer = $this->readLine("Enter $integerName:");

        if (!is_numeric($integer)) {
            throw new InvalidFormatException('numeric');
        }

        return $integer;
    }

    public function newLine(): string
    {
        return "\n";
    }
}