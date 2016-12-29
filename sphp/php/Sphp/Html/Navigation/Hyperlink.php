<?php

/**
 * Hyperlink.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;a&gt; tag
 *
 * If this component has an `href` attribute, then it represents a hyperlink
 * (a hypertext anchor). If the component has no `href` attribute, then the
 * component represents a placeholder for where a link might otherwise have
 * been placed, if it had been relevant.
 *
 * The `target`, `rel`, `media`, `hreflang`, and `type` attributes must be omitted if
 * the `href` attribute is not present.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-14
 * @link    http://www.w3schools.com/tags/tag_a.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Hyperlink extends ContainerTag implements HyperlinkInterface {

  use HyperlinkTrait;

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string $href optional URL of the link
   * @param  string $content optional the content of the component
   * @param  string $target optional value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($href = null, $content = null, $target = null) {
    parent::__construct('a', $content);
    if ($href !== null) {
      $this->setHref($href);
    }
    if ($target !== null) {
      $this->setTarget($target);
    }
  }

}
