<?php

/**
 * Icon.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Icons;

/**
 * Implements icon based on fonts and HTML tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Icon extends AbstractIcon {

  /**
   * Constructs a new instance
   * 
   * @param string|string[] $classes the icon name
   * @param string $screenreaderLabel
   */
  public function __construct($classes, string $screenreaderLabel = null) {
    parent::__construct('i');
    $this->cssClasses()->protect($classes);
    $this->setSreenreaderText($screenreaderLabel);
  }

}
