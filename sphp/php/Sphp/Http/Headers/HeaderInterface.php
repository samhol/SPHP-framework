<?php

/**
 * HeaderInterface.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Http\Headers;

/**
 * Defines a single header
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-16
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface HeaderInterface {

  /**
   * Returns header name
   * 
   * @return string header name
   */
  public function getName();

  /**
   * Returns header value
   * 
   * @return string header value
   */
  public function getValue();

  /**
   * Returns header as a string
   * 
   * @return string header 
   */
  public function __toString();
}
