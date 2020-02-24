<?php

namespace Anso\Framework\Console;

class CommandParser
{
    public function parse(string $input): Command
    {
        $name = strtok($input, ' ');

        $tmpParameters = explode('--', $input);
        $parameters = [];

        foreach ($tmpParameters as $tmpParameter) {
            $tmpParameter = str_replace('--', '', $tmpParameter);
            $parameter = explode('=', $tmpParameter);

            if (isset($parameter[0]) && isset($parameter[1])) {
                $parameters[trim($parameter[0])] = trim($parameter[1]);
            }
        }

        if (!$parameters) {
            $parameter = explode(' ', $input);

            if (isset($parameter[1])) {
                $parameters[] = $parameter[1];
            }
        }

        return new Command($name, $parameters);
    }
}