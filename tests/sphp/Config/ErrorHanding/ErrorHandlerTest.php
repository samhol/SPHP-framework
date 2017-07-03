<?php

namespace Sphp\Config\ErrorHandling;

class ErrorHandlerTest extends \PHPUnit_Framework_TestCase {

  /**
   *
   * @var ErrorDispatcher
   */
  private $errorHandler;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->errorHandler = new ErrorDispatcher();
    set_error_handler($this->errorHandler);
  }

  /**
   *
   */
  public function testParams() {
    $this->errorHandler->addListener(\E_ALL, function () {
      throw new \ErrorException($e->getErrstr(), 0, $e->getErrno(), $e->getErrfile(), $e->getErrline()); //, int $code = 0 [, int $severity = E_ERROR [, string $filename = __FILE__ [, int $lineno );

      if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting, so let it fall
        // through to the standard PHP error handler
        return false;
      }

      switch ($errno) {
        case E_USER_ERROR:
          echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
          echo "  Fatal error on line $errline in file $errfile";
          echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
          echo "Aborting...<br />\n";
          exit(1);
          break;

        case E_USER_WARNING:
          echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
          break;

        case E_USER_NOTICE:
          echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
          break;

        default:
          echo "Unknown error type: [$errno] $errstr<br />\n";
          break;
      }

      /* Don't execute PHP internal error handler */
      return true;
    });
    try {
      trigger_error('foo on line 61', E_USER_ERROR);
    } catch (\Exception $ex) {
      echo $ex . $ex->getSeverity();
    }
  }

}
