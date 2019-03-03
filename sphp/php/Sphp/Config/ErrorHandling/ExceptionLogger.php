<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config\ErrorHandling;

use Throwable;
use Sphp\Stdlib\Filesystem;

/**
 * Logs uncaught exceptions to a file for debugging
 * 
 * Updates the error_log with information about the uncaught Exception and echoes 
 * the exception in an ExceptionBox element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ExceptionLogger implements ExceptionListener {

  /**
   * @var string 
   */
  private $destination;

  /**
   * Constructor
   * 
   * @param string $destination the filename of the destination file
   */
  public function __construct(string $destination) {
    $this->setDestination($destination);
  }

  /**
   * Returns the filename of the destination file
   * 
   * @return string the filename of the destination file
   */
  public function getDestination(): string {
    return $this->destination;
  }

  /**
   * 
   * @param  string $destination
   * @return $this for a fluent interface
   */
  public function setDestination(string $destination) {
    if (!is_writable($destination)) {
      Filesystem::mkFile($destination);
    }
    $this->destination = $destination;
    return $this;
  }

  public function onException(Throwable $e): void {
    error_log($this->parseThrowable($e), 3, $this->getDestination());
  }

  /**
   * parses the throwable to a log message
   * 
   * @param  Throwable $t the throwable to log
   * @return string log message as a string
   */
  protected function parseThrowable(Throwable $t): string {
    $output = "\nDate: " . date(\DATE_RFC2822) . " " . get_class($t) . " was thrown\n";
    $output .= "With message: " . $t->getMessage() . ", (code " . $t->getCode() . ")\n";
    $output .= "----------------------\n";
    $output .= "on line " . $t->getLine() . " of file '" . $t->getFile() . "'\n";
    $output .= "----------------------\n";
    $output .= "Trace:\n" . $t->getTraceAsString() . "\n";
    if ($t->getPrevious() !== null) {
      $output .= "----------------------\n";
      $output .= "Previous exception:\n" . $this->parseThrowable($t->getPrevious()) . "\n";
    }
    $output .= "----------------------\n\n";
    return $output;
  }

}
