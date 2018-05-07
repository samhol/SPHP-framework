<?php

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
 * @link    http://www.w3schools.com/tags/tag_a.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Hyperlink extends ContainerTag implements HyperlinkInterface {

  use HyperlinkTrait;

  /**
   * Constructor
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string|null $href optional URL of the link
   * @param  string|null $content optional the content of the component
   * @param  string|null $target optional value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct(string $href = null, string $content = null, string $target = null) {
    parent::__construct('a', $content);
    if ($href !== null) {
      $this->setHref($href);
    }
    if ($target !== null) {
      $this->setTarget($target);
    }
  }

}
