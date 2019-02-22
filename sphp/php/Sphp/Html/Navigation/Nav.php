<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
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
   * Constructor
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
