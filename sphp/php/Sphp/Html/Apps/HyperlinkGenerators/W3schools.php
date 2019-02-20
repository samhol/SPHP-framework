<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use Sphp\Html\Navigation\Hyperlink;

/**
 * Hyperlink generator pointing to online w3schools documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class W3schools extends AbstractLinker {

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct(new UrlGenerator('http://www.w3schools.com/'));
  }

  /**
   * Returns a hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   * 
   * @param  string $tagname the HTML5 tag name
   * @return Hyperlink hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   */
  public function __get(string $tagname): Hyperlink {
    return $this->tag($tagname);
  }

  /**
   * Returns a hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   * 
   * @param  string $tagname the HTML5 tag name
   * @param  string $linkText optional content of the link
   * @param  string $title
   * @return Hyperlink hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   */
  public function tag(string $tagname, string $linkText = null, string $title = null): Hyperlink {
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
    if ($title === null) {
      $title = "Link to w3schools.com $tagname documentation";
    }
    return $this->hyperlink($this->urls()->createUrl($link), $linkText, $title);
  }

  /**
   * Returns a hyperlink object pointing to the w3schools documentation of the given HTML5 tag attribute
   * 
   * @param  string $attrName the HTML5 tag name
   * @param  string $linkText optional content of the link
   * @return Hyperlink hyperlink object pointing to the w3schools documentation of the given HTML5 tag
   */
  public function attr(string $attrName, string $linkText = null): Hyperlink {
    $link = "tags/att_$attrName.asp";
    if ($linkText === null) {
      $linkText = "$attrName Attribute";
    }
    return $this->hyperlink($this->urls()->createUrl($link), $linkText, 'Link to w3schools.com documentation');
  }

}
