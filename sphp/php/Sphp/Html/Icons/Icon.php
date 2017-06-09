<?php

/**
 * Icon.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Icons;

use Sphp\Stdlib\Strings;

/**
 * Description of Icon
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-05-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Icon extends AbstractIcon {

  /**
   * 
   * @param  string|string[] $iconName the icon name 
   * @param  string $tagName the tag name 
   * @throws \Sphp\Exceptions\InvalidArgumentException if the tag name is not valid
   */
  public function __construct(string $iconName, string $tagName = 'i') {
    parent::__construct($tagName);
    $this->cssClasses()->lock($iconName);
  }

  /**
   * 
   * @param string $icon
   */
  public static function fontAwesome(string $icon) {
    if (!Strings::startsWith($icon, 'fa-')) {
      $icon = 'fa-' . $icon;
    }
    $component = static::get($icon, 'i');
    $component->cssClasses()->lock('fa');
    return $component;
  }

  /**
   * 
   * @param  string $iconName the icon name 
   * @param  string $tagName the tag name 
   * @return self
   * @throws \Sphp\Exceptions\InvalidArgumentException if the tag name is not valid
   */
  public static function foundation(string $iconName, string $tagName = 'i') {
    if (!Strings::startsWith($iconName, 'fi-')) {
      $iconName = 'fi-' . $iconName;
    }
    $obj = static::get($iconName, $tagName);
    $obj->cssClasses()->lock('fi');
    return $obj;
  }

  /**
   * 
   * @param  string $iconName the icon name 
   * @param  string $tagName the tag name 
   * @return self
   * @throws \Sphp\Exceptions\InvalidArgumentException if the tag name is not valid
   */
  public static function get(string $iconName, string $tagName = 'i') {
    return new static($iconName, $tagName);
  }

}
