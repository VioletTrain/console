<?php

namespace Anso\Framework\Console\Exception;

use Anso\Framework\Contract\ApplicationException;
use Exception;
use Throwable;

class InvalidFormatException extends Exception implements ApplicationException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Input must be " . $message;
        parent::__construct($message, $code, $previous);
    }
}