<?php

namespace Anso\Framework\Console;

use Anso\Framework\Console\Contract\Command as CommandContract;

class Command implements CommandContract
{
    private string $name;

    private array $parameters;

    public function __construct(string $name, array $parameters)
    {
        $this->name = $name;
        $this->parameters = $parameters;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function parameters(): array
    {
        return $this->parameters;
    }
}