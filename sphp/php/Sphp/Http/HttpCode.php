<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Http;

/**
 * Implements a http code
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class HttpCode {

  /**
   * @var int 
   */
  private $code;

  /**
   * @var string 
   */
  private $message;

  /**
   * @var string 
   */
  private $description;

  /**
   * Construct a new instance
   * 
   * @param int $code
   * @param string $message
   * @param string $description
   */
  public function __construct(int $code, string $message, string $description) {
    $this->code = $code;
    $this->message = $message;
    $this->description = $description;
  }

  /**
   * Returns the http code
   * 
   * @return int the http code
   */
  public function getCode(): int {
    return $this->code;
  }

  /**
   * 
   * @return string
   */
  public function getMessage(): string {
    return $this->message;
  }

  /**
   * 
   * @return string
   */
  public function getDescription(): string {
    return $this->description;
  }

}
