<?php


namespace Mts\Lib\Core;


class Application extends Container
{
    public function start()
    {
        ob_start();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            if (0 === error_reporting()) {
                return false;
            }
            throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
    }

    public static function close($done = 0)
    {
        if (!$done) {
            http_response_code(404);
            echo json_encode(['error' => 'url not found']);
        }
        $size = ob_get_length();
        header('Content-Length: ' . $size);
        header('Connection: close');
        ob_end_flush();
        ob_flush();
        flush();
    }
}