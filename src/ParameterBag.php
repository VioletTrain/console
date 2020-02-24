<?php

namespace Anso\Framework\Console;

class ParameterBag
{
    private array $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function get(string $parameterName)
    {
        return $this->parameters[$parameterName] ?? null;
    }

    public function first()
    {
        return reset($this->parameters);
    }

    public function getOrFirst(string $parameterName)
    {
        return $this->get($parameterName) ?? $this->first();
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}