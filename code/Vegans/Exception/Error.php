<?php

/**
 *
 * @author Francesco Borriello <infoborriello@gmail.com>
 * @company Vegan Solution
 * @package Vegans
 *
 */
namespace VegansException;
use Throwable;

class Error extends \Exception {

    /**
     * Error constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null){
        @set_exception_handler(array($this, 'exception_handler'));
        parent::__construct($message, $code, $previous);
    }

    /**
     * Exception handler
     * @param $exception
     */
    public function exception_handler($exception) {
        header("HTTP/1.0 500 Internal Server Error");
        print "| Exception Caught: ". $exception->getMessage() ."\n";
    }
}


