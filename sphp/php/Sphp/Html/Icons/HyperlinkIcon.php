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
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HyperlinkIcon extends AbstractHyperlinkIcon {

  use \Sphp\Html\ContentTrait;
  use \Sphp\Html\Navigation\HyperlinkTrait;

  /**
   * Constructs a new instance
   * 
   * @param string $iconName
   */
  public function __construct(string $url, $iconName, string $target = null) {
    if (!$iconName instanceof AbstractIcon) {
      $iconName = new Icon($iconName);
    }
    parent::__construct($url, $iconName, $target);
  }

  /**
   * 
   * @param  string $url
   * @param  string $icon
   * @param  string $target
   * @return HyperlinkIcon
   */
  public static function fontAwesome(string $url, string $icon, string $target = null) {
    $iconComponent = Icons::fontAwesome($icon);
    return new static($url, $iconComponent, $target);
  }

  /**
   * Creates a new hyperlink icon object using Foundation icons
   * 
   * @param  string $href the URL of the hyperlink
   * @param  string $icon the css class name of the foundation icon
   * @param  string|null $target optional target frame of the hyperlink
   * @return self the hyperlink icon generated
   */
  public static function foundation(string $href, string $icon, string $target = null) {
    $iconComponent = Icons::foundation($icon);
    return new static($href, $iconComponent, $target);
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
