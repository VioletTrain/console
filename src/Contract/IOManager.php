<?php

namespace Anso\Framework\Console\Contract;

interface IOManager
{
    public function readLine($prompt = ''): string;

    public function writeLine(string $output): void;

    public function readInteger(string $integerName): int;

    public function newLine(): string;
}