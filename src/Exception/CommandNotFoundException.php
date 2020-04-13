<?php

namespace Anso\Framework\Console\Exception;

use Anso\Framework\Base\Contract\ApplicationException;
use Exception;
use Throwable;

class CommandNotFoundException extends Exception implements ApplicationException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "'" . $message . "' command was not found";
        parent::__construct($message, $code, $previous);
    }
}