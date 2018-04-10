<?php

/**
 * Nav.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\TraversableContent;
use Sphp\Html\ContainerTag;
/**
 * Implements an HTML &lt;nav&gt; tag
 *
 * This object defines a set of navigation links.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_nav.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
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
   * @return TraversableContent containing {@link HyperlinkInterface} sub components
   */
  public function hyperlinks(): TraversableContent {
    return $this->getComponentsByObjectType(HyperlinkInterface::class);
  }

}
