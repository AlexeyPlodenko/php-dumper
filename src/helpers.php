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

            echo($isCli ? "\n\n" : '<hr>');
        }

        // output backtrace
        $ex = new Exception();
        print_r($ex->getTraceAsString());

        if (!$isCli) {
            echo '</pre>';
        }

        exit;
    }
}
