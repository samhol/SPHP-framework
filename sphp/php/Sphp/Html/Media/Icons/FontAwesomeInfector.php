<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Media\Icons;
use Sphp\Html\CssClassifiableContent;
/**
 * Description of FontAwesomeInfector
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FontAwesomeInfector {
  
  
  /**
   * @var string[]
   */
  private $props = [];

  public function __construct(array $classes = []) {
    $this->classes = $classes;
  }

  /**
   * Creates an icon object
   *
   * @param  string $fileType the file type
   * @param  string $screenReaderText 
   * @return FaIcon the corresponding component
   */
  public function __invoke(string $fileType, string $screenReaderText = null): FaIcon {
    return static::get($fileType, $screenReaderText);
  }

  /**
   * Creates an icon object
   *
   * @param  string $fileType the file type
   * @param  array $arguments 
   * @return FaIcon the corresponding component
   */
  public function infect(CssClassifiableContent $icon): CssClassifiableContent {
    foreach ($this->props as $propertyName => $value) {
      $icon->$propertyName($value);
    }
    return $icon;
  }

  /**
   * Optionally pulls the icon to left or right
   * 
   * @param  string|null $direction the direction of th pull
   * @return $this for a fluent interface
   */
  public function pull(CssClassifiableContent $component, string $direction = null) {
    $component->cssClasses()->remove('fa-pull-left', 'fa-pull-right');
    $direction = 'fa-pull-' . $direction;
    if ($direction === 'fa-pull-left' || $direction === 'fa-pull-right') {
      $component->cssClasses()->add($direction);
    }
    return $this;
  }

  /**
   * Sets/unsets the width of the icon fixed
   * 
   * @param bool $fixedWidth
   * @return $this for a fluent interface
   */
  public function fixedWidth(CssClassifiableContent $component, bool $fixedWidth = true) {
    if ($fixedWidth) {
      $component->cssClasses()->add('fa-fw');
    } else {
      $component->cssClasses()->remove('fa-fw');
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
