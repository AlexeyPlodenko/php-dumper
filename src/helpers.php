<?php

if (!function_exists('d')) {
    /**
     * @param ...$args
     * @return void
     */
    function d(...$args)
    {
        $isCli = (php_sapi_name() === 'cli');

        // empty the output buffers, so the page would contain only the debug messages
        while (ob_get_level()) {
            ob_end_clean();
        }

        // send the HTTP 500 status header
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);

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
