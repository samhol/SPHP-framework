<?php

/**
 * SQLException.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db;

use Exception;

/**
 * Exception class for SQL syntax execution failures
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @update  2011-03-08

 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SQLException extends Exception {

  /**
   * the possible query executed when the exception occurs
   *
   * @var string
   */
  private $query;

  /**
   * Constructs a new instance of the {@link self} object
   *
   * @param string $message the exception message to throw
   * @param int $code the Exception code
   * @param string $query the possible query executed when the exception occurs
   * @param \Exception $previous the previous exception used for the exception chaining
   */
  public function __construct($message = "", $code = 0, $query = "", Exception $previous = null) {
    parent::__construct($message, (int) $code, $previous);
    $this->query = $query;
  }

  /**
   * Returns the SQL query string
   *
   * @return string the SQL query string
   */
  public function getSqlQuery() {
    return $this->query;
  }

}
