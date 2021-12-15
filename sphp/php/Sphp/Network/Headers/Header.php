<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Headers;

/**
 * Defines a single header
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Header {

  /**
   * Returns header name
   * 
   * @return string header name
   */
  public function getName(): string;

  /**
   * Returns header value
   * 
   * @return mixed header value
   */
  public function getValue();

  /**
   * Returns header as a string
   * 
   * @return string header 
   */
  public function __toString(): string;

  /**
   * Saves the cookie
   *
   * @return bool whether the header has successfully been sent
   */
  public function save(): bool;

  /**
   * Deletes the cookie
   *
   * @return bool whether the header has successfully been deleted
   */
  public function delete(): bool;
}
