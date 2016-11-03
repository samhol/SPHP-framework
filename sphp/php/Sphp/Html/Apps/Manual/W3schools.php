<?php

/**
 * W3schoolsLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Navigation\Hyperlink;

/**
 * Hyperlink generator pointing to online w3schools documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class W3schools extends AbstractLinker {

  /**
   * Constructs a new instance
   * 
   * @param string|null $target the default value of the attributes used in the 
   *        generated links
   */
  public function __construct($target = '_blank') {
    parent::__construct(new UrlGenerator('http://www.w3schools.com/'), $target);
  }

  /**
   * Returns a hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   * 
   * @param  string $tagname the HTML5 tag name
   * @param  string $linkText optional content of the link
   * @return Hyperlink hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   */
  public function tag($tagname, $linkText = null) {
    if (preg_match('/^([h][1-6])$/', $tagname)) {
      $link = 'tags/tag_hn.asp';
    } else {
      $link = "tags/tag_$tagname.asp";
    }
    if ($linkText === null) {
      if ($tagname === 'hn') {
        $linkText = '&lt;h1|h2|...|h6&gt;';
      } else {
        $linkText = "&lt;$tagname&gt;";
      }
    }
    return $this->hyperlink($this->urls()->create($link), $linkText, 'Link to w3schools.com documentation');
  }

  /**
   * Returns a hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   * 
   * @param  string $attrName the HTML5 tag name
   * @param  string $linkText optional content of the link
   * @return Hyperlink hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   */
  public function attr($attrName, $linkText = null) {
    $link = "tags/att_$attrName.asp";
    if ($linkText === null) {
      $linkText = "$attrName Attribute";
    }
    return $this->hyperlink($this->urls()->create($link), $linkText, 'Link to w3schools.com documentation');
  }

}
