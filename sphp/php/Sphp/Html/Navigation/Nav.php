<?php

/**
 * Nav.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;nav&gt; tag
 *
 * The {@link self} object defines a set of navigation links ({@link HyperlinkInterface}).
 *
 * Notice that NOT all links of a document should be inside a {@link self} object.
 * The {@link self} object is intended only for major block of navigation links.
 *
 * Browsers, such as screen readers for disabled users, can use this element to
 * determine whether to omit the initial rendering of this content.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-03-06
 * @link    http://www.w3schools.com/tags/tag_nav.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Nav extends ContainerTag {

  /**
   * Constructs a new instance
   *
   * @param  mixed $content optional content of the component
   */
  public function __construct($content = null) {
    parent::__construct('nav', $content);
  }

  /**
   * Returns the hyperlink sub components
   *
   * @return ContainerInterface containing {@link HyperlinkInterface} sub components
   */
  public function hyperlinks() {
    return $this->getComponentsByObjectType(HyperlinkInterface::class);
  }

}
