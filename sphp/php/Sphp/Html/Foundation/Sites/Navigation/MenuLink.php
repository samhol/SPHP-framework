<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Navigation\HyperlinkContainer;
use Sphp\Html\Navigation\Hyperlink;

/**
 * Implements a hyperlink component for the menu component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/subnav.html Foundation Sub Nav
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MenuLink extends HyperlinkContainer implements MenuItem {

  /**
   * Constructor
   *
   * **Notes:**
   *
   * * The `href` attribute specifies the URL of the page the link goes to.
   * * If the `href` attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   * * If the $content is empty, the `$href` is also the content of the object.
   *
   * @param  string $href the URL of the link
   * @param  string $content link tag's content
   * @param  string|null $target optional target frame of the hyperlink
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct(string $href = '', $content = null, string $target = null) {
    parent::__construct('li', new Hyperlink($href, $content, $target));
  }

  /**
   * Sets or unsets the hyperlink component as active
   *
   * @param  boolean $active true for activation and false for deactivation
   * @return $this for a fluent interface
   */
  public function setActive(bool $active = true) {
    if ($active) {
      $this->addCssClass('active');
    } else {
      $this->removeCssClass('active');
    }
    return $this;
  }

  /**
   * Checks whether the hyperlink component is set as active or not
   *
   * @return boolean true if the hyperlink component is set as active, otherwise false
   */
  public function isActive(): bool {
    return $this->hasCssClass('active');
  }

}
