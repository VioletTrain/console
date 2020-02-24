<?php

namespace Anso\Framework\Console\Contract;

interface Command
{
    public function name(): string;

    public function parameters(): array;
}