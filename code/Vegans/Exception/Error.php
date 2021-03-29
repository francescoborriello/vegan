<?php

/**
 *
 * @author Francesco Borriello <infoborriello@gmail.com>
 * @company Vegan Solution
 * @package Vegans\Exception
 *
 */
namespace VegansException;

/**
 * Class Error
 * @package VegansException
 *
 */
class Error{

    /**
     * Error constructor.
     * @param $message
     * @throws \Exception
     */
    public function __construct($message) {
        @set_exception_handler(array($this, 'exception_handler'));
        throw new \Exception('DOH!!! ' . $message);
    }

    /**
     * Exception handler
     * @param $exception
     */
    public function exception_handler($exception) {
        print "Exception Caught: ". $exception->getMessage() ."\n";
    }
}


