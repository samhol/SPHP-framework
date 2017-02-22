<?php

/**
 * HyperlinkListItem.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Lists;

use Sphp\Html\Navigation\HyperlinkContainer;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Stdlib\URL;

/**
 * Implements a hyperlink type menu item
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-04
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HyperlinkListItem extends HyperlinkContainer implements LiInterface {

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   * * If the $content is empty, the $href is also the content of the object.
   *
   * @param  string|URL $href the URL of the link
   * @param  string $content optional content of the component
   * @param  string $target optional value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($href = null, $content = null, $target = null) {
    parent::__construct('li', new Hyperlink($href, $content, $target));
  }

}
