<?php

/**
 * FaIcon.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Stdlib\Strings;

/**
 * Implements icon based on fonts and HTML tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FaIcon extends AbstractIcon {

  /**
   * Constructs a new instance
   * 
   * @param string|string[] $iconName the icon name
   * @param string $screenreaderLabel
   */
  public function __construct($iconName, string $screenreaderLabel = null) {
    parent::__construct('i');
    $this->cssClasses()->protect($iconName);
    $this->setSreenreaderText($screenreaderLabel);
  }

  /**
   * Optionally pulls the icon to left or right
   * 
   * @param  string|null $direction the direction of th pull
   * @return $this for a fluent interface
   */
  public function pull(string $direction = null) {
    $this->cssClasses()->remove('fa-pull-left', 'fa-pull-right');
    $direction = 'fa-pull-' . $direction;
    if ($direction === 'fa-pull-left' || $direction === 'fa-pull-right') {
      $this->cssClasses()->add($direction);
    }
    return $this;
  }

  /**
   * Sets the size of the icon
   * 
   * @param  string|null $size the size of the icon
   * @return $this for a fluent interface
   */
  public function setSize(string $size = null) {
    $this->cssClasses()->removePattern('/^(fa-(xs|sm|lg|([2-9]|10)x))+$/');
    if ($size !== null) {
      if (!Strings::startsWith($size, 'fa-')) {
        $size = 'fa-' . $size;
      }
      if (Strings::match($size, '/^(fa-(xs|sm|lg|([2-9]|10)x))+$/')) {
        $this->cssClasses()->add($size);
      }
    }
    return $this;
  }

}
