<?php

namespace Anso\Framework\Console\Contract;

use Anso\Framework\Console\ParameterBag;

interface CommandHandler
{
    /**
     * @param ParameterBag $parameters
     * @return string
     * @throws \Throwable
     */
    public function handle(ParameterBag $parameters): string;

    public static function description(): string;
}