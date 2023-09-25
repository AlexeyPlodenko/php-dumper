<?php

if (!function_exists('d')) {
    /**
     * @param ...$args
     * @return void
     */
    function d(...$args)
    {
        $isCli = (php_sapi_name() === 'cli');

        if (!$isCli) {
            echo '<pre>';
        }

        foreach ($args as $arg) {
            if ($arg === null) {
                echo 'NULL';
            } elseif (is_string($arg)) {
                echo $arg ?: '(empty string)';
            } else {
                print_r($arg);
            }

            echo ($isCli ? "\n\n" : '<hr>');
        }

        // output backtrace
        $ex = new Exception();
        print_r($ex->getTraceAsString());

        if (!$isCli) {
            echo '</pre>';

            // output to the STDERR also
            foreach ($args as $arg) {
                if (is_scalar($arg)) {
                    error_log((string)$arg);
                } else {
                    error_log(json_encode($arg));
                }
            }
            error_log(str_repeat('^', 80));
        }

        exit(1);
    }
}
