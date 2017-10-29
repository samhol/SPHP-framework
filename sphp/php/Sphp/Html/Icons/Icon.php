<?php

/**
 * Icon.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Icons;

/**
 * Implements icon based on fonts and HTML tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Icon extends AbstractIcon {

  /**
   * Constructs a new instance
   * 
   * @param string $classes the icon name
   */
  public function __construct(string ... $classes) {
    parent::__construct('i');
    $this->cssClasses()->protect($classes);
  }

}
