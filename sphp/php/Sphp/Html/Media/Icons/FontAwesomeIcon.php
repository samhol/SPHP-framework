<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
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
class FontAwesomeIcon extends IconTag {

  /**
   * Constructor
   * 
   * @param string $iconName the icon name
   * @param string $title the title of the icon
   */
  public function __construct(string $iconName, string $title = null) {
    parent::__construct($iconName);
    $this->cssClasses()->protectValue($iconName);
    $this->setTitle($title);
  }

  /**
   * Sets the title of the icon
   * 
   * @param  string $title the title of the icon
   * @return $this for a fluent interface
   */
  public function setTitle(string $title = null) {
    $this->attributes()->setAttribute('title', $title);
    if ($title !== null) {
      $this->attributes()->remove('aria-hidden');
    }
    return $this;
  }

  /**
   * Optionally pulls the icon to left or right
   * 
   * @param  string|null $direction the direction of the pull
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
   * Sets/unsets the borders around the icon
   * 
   * @param bool $borders
   * @return $this for a fluent interface
   */
  public function useBorders(bool $borders = true) {
    if ($borders) {
      $this->cssClasses()->add('fa-border');
    } else {
      $this->cssClasses()->remove('fa-border');
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
