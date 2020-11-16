<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\ContainerTag;

/**
 * Implementation of an HTML nav tag
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
   * Appends an HTML &lt;a&gt; object
   * 
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string|null $href optional URL of the link
   * @param  string|null $content optional the content of the component
   * @param  string|null $target optional value of the target attribute
   * @return A appended object
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendHyperlink(string $href = null, $content = null, string $target = null): A {
    $component = new A($href, $content, $target);
    $this->append($component);
    return $component;
  }
  
  public function getHyperlinks(): iterable {
    return $this->getComponentsByObjectType(Hyperlink::class);
  }

}
