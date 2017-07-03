<?php

/*
 * ErrorExceptionThrower.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config\ErrorHandling;

//use ErrorException;
use Sphp\Exceptions\ErrorException;

/**
 * Implements an Error Excception thrower
 * 
 *  An instance of this class catches PHP errors and converts them to an exception 
 *  that can be caught at runtime.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ErrorExceptionThrower {

    /**
     * Starts redirecting PHP errors
     * 
     * @param int $level PHP Error level to catch (Default = E_ALL & ~E_DEPRECATED)
     */
    public function start(int $level = \E_ALL) {
        set_error_handler($this, $level);
        register_shutdown_function(array($this, 'fatalErrorShutdownHandler'));
        return $this;
    }

    /**
     * Stops redirecting PHP errors
     */
    public function stop() {
        restore_error_handler();
        return $this;
    }

    /**
     * Shutdown handler for fatal errors
     * 
     * @throws ErrorException
     */
    public function fatalErrorShutdownHandler() {
        $last_error = error_get_last();
        if ($last_error['type'] === \E_ERROR) {
            // fatal error
            $this->handleError(\E_ERROR, $last_error['message'], $last_error['file'], $last_error['line']);
        }
    }

    /**
     * Fired by the PHP error handler function
     * 
     * Calling this function will always throw an exception unless `error_reporting == 0`.
     * If the PHP command is called with @ preceeding it, then it will be ignored 
     * here as well.
     * 
     * @param  int $errno the level of the error raised, as an integer
     * @param  string $errstr the error message
     * @param  string $errfile the filename where the exception is thrown
     * @param  int $errline the line number where the exception is thrown
     * @throws \Sphp\Exceptions\ErrorException
     */
    public function __invoke(int $errno, string $errstr, string $errfile, int $errline): bool {
        if (!(error_reporting() & $errno)) {
            return false;
        }
        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }

}
