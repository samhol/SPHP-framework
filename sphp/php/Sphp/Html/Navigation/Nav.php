<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\Layout\AbstractFlowContainer;
use Sphp\Html\TraversableContent;

/**
 * Implementation of an HTML nav tag
 *
 * This object defines a set of navigation links.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_nav.asp w3schools HTML API
 * @link    https://www.w3schools.com/tags/tag_nav.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Nav extends AbstractFlowContainer {

  /**
   * Constructor
   *
   * @param  mixed $content optional content of the component
   * @link   https://php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct(mixed $content = null) {
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
   * @param  mixed $content optional the content of the component
   * @param  string|null $target optional value of the target attribute
   * @return A appended object
   * @link   https://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   https://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendHyperlink(?string $href = null, $content = null, ?string $target = null): A {
    $component = new A($href, $content, $target);
    $this->append($component);
    return $component;
  }

  /**
   * Returns the hyperlink objects
   * 
   * @return TraversableContent<Hyperlink>
   */
  public function getHyperlinks(): TraversableContent {
    return $this->getComponentsByObjectType(Hyperlink::class);
  }

}
