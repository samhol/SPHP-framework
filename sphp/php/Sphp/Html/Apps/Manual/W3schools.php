<?php

/**
 * W3schoolsLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Navigation\Hyperlink;
use Sphp\Core\Types\Strings;

/**
 * Link generator for w3schools Docs related hyperlinks
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class W3schools extends AbstractLinker {

  /**
   *
   * @var self
   */
  private static $default;

  /**
   * Constructs a new instance
   * 
   * @param scalar[] $attrs the default value of the attributes used in the 
   *        generated links
   */
  public function __construct($attrs = '_blank') {
    parent::__construct('http://www.w3schools.com/', $attrs);
  }

  /**
   * Returns a hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   * 
   * @param  string $tagname the HTML5 tag name
   * @param  string $linkText optional content of the link
   * @return Hyperlink hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   */
  public function tag($tagname, $linkText = null) {
    if (Strings::match($tagname, '/^([h][1-6])$/')) {
      $link = 'tags/tag_hn.asp';
    } else {
      $link = "tags/tag_$tagname.asp";
    }
    if (Strings::isEmpty($linkText)) {
      if ($tagname === 'hn') {
        $linkText = '&lt;h1|h2|...|h6&gt;';
      } else {
        $linkText = "&lt;$tagname&gt;";
      }
    }
    return $this->hyperlink($link, $linkText, 'Link to w3schools.com documentation');
  }

  /**
   * Returns a hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   * 
   * @param  string $tagname the HTML5 tag name
   * @param  string $linkText optional content of the link
   * @return Hyperlink hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   */
  public function attr($attrName, $linkText = null) {
    $link = "tags/att_$attrName.asp";
    if (Strings::isEmpty($linkText)) {
      $linkText = "$attrName Attribute";
    }
    return $this->hyperlink($link, $linkText, 'Link to w3schools.com documentation');
  }

  /**
   * 
   * @return self new instance of linker
   */
  public static function get() {
    if (self::$default === null) {
      self::$default = new static();
    }
    return self::$default;
  }

}
