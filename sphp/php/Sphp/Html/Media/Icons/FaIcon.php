<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
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
   * Constructor
   * 
   * @param string|string[] $iconName the icon name
   * @param string $screenreaderLabel
   */
  public function __construct($iconName, string $screenreaderLabel = null) {
    parent::__construct('i');
    $this->cssClasses()->protectValue($iconName);
    $this->setAriaLabel($screenreaderLabel);
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
   * Sets/unsets the width of the icon fixed
   * 
   * @param bool $fixedWidth
   * @return $this for a fluent interface
   */
  public function fixedWidth(bool $fixedWidth = true) {
    if ($fixedWidth) {
      $this->cssClasses()->add('fa-fw');
    } else {
      $this->cssClasses()->remove('fa-fw');
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
