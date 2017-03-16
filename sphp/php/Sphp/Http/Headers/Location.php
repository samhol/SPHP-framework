<?php

/**
 * Location.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Http\Headers;

/**
 * Location header
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-16
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Location extends AbstractHeader {

  public function __construct($value) {
    $this->setValue($value);
  }

  public function getName() {
    return 'location';
  }
  
  public function execute() {
    header($this->__toString());
  }

}
