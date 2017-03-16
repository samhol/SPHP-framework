<?php

/**
 * HttpCode.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Http;

/**
 * The Logger class is responsible for printing the uncaught exceptions as an HTML element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HttpCode {

  /**
   *
   * @var int 
   */
  private $code;

  /**
   *
   * @var string 
   */
  private $message;

  /**
   *
   * @var string 
   */
  private $description;

  /**
   * 
   * @param int $code
   * @param string $message
   * @param string $description
   */
  public function __construct($code, $message, $description) {
    $this->code = $code;
    $this->message = $message;
    $this->description = $description;
  }

  /**
   * 
   * @return string
   */
  public function getCode() {
    return $this->code;
  }

  /**
   * 
   * @return string
   */
  public function getMessage() {
    return $this->message;
  }

  /**
   * 
   * @return string
   */
  public function getDescription() {
    return $this->description;
  }

}
