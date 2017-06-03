<?php

/**
 * HyperlinkIcon.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Icons;

/**
 * Description of HyperlinkIcon
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-05-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HyperlinkIcon extends AbstractHyperlinkIcon {

  use \Sphp\Html\ContentTrait;
  use \Sphp\Html\Navigation\HyperlinkTrait;

  /**
   * 
   * @param string $iconName
   */
  public function __construct($url, $iconName, $target = null) {
    if (!$iconName instanceof AbstractIcon) {
      $iconName = new Icon($iconName);
    }
    parent::__construct($url, $iconName, $target);
  }

  /**
   * 
   * @param string $icon
   */
  public static function fontAwesome($url, $icon, $target = null) {
    $iconComponent = Icon::fontAwesome($icon);
    return static::get($url, $iconComponent, $target);
  }

  /**
   * Creates a new hyperlink icon object using Foundation icons
   * 
   * @param  string $href the URL of the hyperlink
   * @param  string $icon the css class name of the foundation icon
   * @param  string|null $target optional target frame of the hyperlink
   * @return self the hyperlink icon generated
   */
  public static function foundation($href, $icon, $target = null) {
    $iconComponent = Icon::foundation($icon);
    return static::get($href, $iconComponent, $target);
  }

  /**
   * 
   * @param  string $href
   * @param  string|AbstractIcon $icon the icon object or classname(s) describing the icon 
   * @param  string $target
   * @return self
   */
  public static function get($href, $icon, $target = null) {
    return new static($href, $icon, $target);
  }

}
