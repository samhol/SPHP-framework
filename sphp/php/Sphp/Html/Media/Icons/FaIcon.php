<?php

/**
 * FaIcon.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Icons;

/**
 * Implements icon based on fonts and HTML tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FaIcon extends AbstractIcon {

  /**
   * Constructs a new instance
   * 
   * @param string|string[] $classes the icon name
   * @param string $screenreaderLabel
   */
  public function __construct($iconName, string $screenreaderLabel = null) {
    parent::__construct('i');
   /* if (!Strings::startsWith($iconName, 'fa-')) {
      $iconName = "fa-$iconName";
    }*/
    $this->cssClasses()->protect($iconName);
    $this->setSreenreaderText($screenreaderLabel);
  }

}
