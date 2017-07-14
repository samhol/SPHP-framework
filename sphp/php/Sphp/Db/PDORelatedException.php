<?php

/**
 * SQLException.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db;

/**
 * Exception class for SQL syntax execution failures
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @update 2011-03-08
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PDORelatedException extends \PDOException {

  /**
   * Constructs a new instance of the {@link self} class
   *
   * @param \PDOException $e the original exception thrown
   */
  public function __construct(\PDOException $e) {
    if (strstr($e->getMessage(), 'SQLSTATE[')) {
      //$matches = [];
      preg_match('/SQLSTATE\[(\w+)\](\:*) (.*)/', $e->getMessage(), $matches);
      //print_r($matches);
      //echo $e->getMessage();
      $code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]);
      $message = $matches[3];
      parent::__construct($message, intval($code), $e);
    } else {
      parent::__construct($e->getMessage(), $e->getCode(), $e);
    }
  }

}
