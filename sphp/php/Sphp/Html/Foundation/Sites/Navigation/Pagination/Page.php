<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Navigation\HyperlinkContainer;
use Sphp\Network\URL;

/**
 * Implements a page button for a Pagination component
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/pagination.html Foundation Pagination
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Page extends HyperlinkContainer implements PageInterface {

  /**
   * Constructor
   *
   * **Notes:**
   * 
   * * The `href` attribute specifies the URL of the page the link goes to.
   * * If the `href` attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string|URL $href the URL of the link
   * @param  string|null $content the content of the page link
   * @param  string $target optional value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct(string $href = null, $content = null, string $target = null) {
    parent::__construct('li',new Hyperlink($href, $content, $target));
    //$this->hyperlink = new Hyperlink($href, $content, $target);
  }

  /**
   * 
   * @param  string $label
   * @return $this for a fluent interface
   * @link   https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_aria-label_attribute
   */
  public function setAriaLabel($label) {
    $this->attributes()->setAria('label', $label);
    return $this;
  }

  public function setCurrent(bool $active = true) {
    if ((boolean) $active) {
      return $this->addCssClass('current');
    } else {
      return $this->removeCssClass('current');
    }
  }

  public function isCurrent(): bool {
    return $this->hasCssClass('current');
  }

  public function disable(bool $disabled = true) {
    if ($disabled) {
      $this->cssClasses()->add('disabled');
    } else {
      $this->cssClasses()->remove('disabled');
    }
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->cssClasses()->contains('disabled');
  }

  public function contentToString(): string {
    $output = '';
    if( $this->getHref() === false ||  $this->getHref() === null) {
      $this->disable(true);
    }
    if (!$this->isEnabled() || $this->isCurrent() || $this->getHref() === null) {
      $output .= "<span>{$this->getHyperlink()->contentToString()}</span>";
    } else {
      $output .= parent::contentToString();
    }
    return $output;
  }

}
