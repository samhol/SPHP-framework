<?php

/**
 * W3schoolsLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\ApiTools;

use Sphp\Html\Navigation\Hyperlink as Hyperlink;
use Sphp\Core\Types\Strings as Strings;

/**
 * Link generator for w3schools Docs related hyperlinks
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class W3schoolsLinker extends AbstractLinker {

  /**
   * Constructs a new instance
   * 
   * @param scalar[] $attrs the default value of the attributes used in the 
   *        generated links
   */
  public function __construct($attrs = ["target" => "w3schools", "class" => "api w3schools-docs-link"]) {
    parent::__construct("http://www.w3schools.com/", $attrs);
  }

  /**
   * Returns a hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   * 
   * @param  string $tagname the HTML5 tag name
   * @param  string $linkText optional content of the link
   * @return Hyperlink hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   */
  public function getTagLink($tagname, $linkText = null) {
    if (Strings::match($tagname, "/^([h][1-6])$/")) {
      $link = "tags/tag_hn.asp";
    } else {
      $link = "tags/tag_$tagname.asp";
    }
    if (Strings::isEmpty($linkText)) {
      if ($tagname === "hn") {
        $linkText = "&lt;h1|h2|...|h6&gt;";
      } else {
        $linkText = "&lt;$tagname&gt;";
      }
    }
    return $this->getHyperlink($link, $linkText, "Link to w3schools.com documentation");
  }

}
