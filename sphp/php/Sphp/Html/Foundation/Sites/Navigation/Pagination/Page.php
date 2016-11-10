<?php

/**
 * Page.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

use Sphp\Html\Lists\HyperlinkListItem as HyperlinkListItem;
use Sphp\Core\Types\URL;

/**
 * Class implements a page button for Foundation 6 Pagination component
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/pagination.html Foundation Pagination
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Page extends HyperlinkListItem implements PageInterface {

  /**
   * Constructs a new instance
   *
   * **Notes:**
   * 
   * * The `href` attribute specifies the URL of the page the link goes to.
   * * If the `href` attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string|null $content the content of the page link
   * @param  string|URL $href the URL of the link
   * @param  string $target optional value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($content = null, $href = null, $target = '_self') {
    parent::__construct($href, $content, $target);
  }

  /**
   * 
   * @param  string $label
   * @return self for PHP Method Chaining
   * @link   https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Techniques/Using_the_aria-label_attribute
   */
  public function setAriaLabel($label) {
    $this->attrs()->setAria('label', $label);
    return $this;
  }

  public function activate() {
    if ($this->urlEquals(URL::getCurrent())) {
      $this->setCurrent(true);
    } else {
      $this->setCurrent(false);
    }
    return $this;
  }

  public function setCurrent($active = true) {
    if ($active) {
      return $this->addCssClass('current');
    } else {
      return $this->removeCssClass('current');
    }
  }

  public function isCurrent() {
    return $this->hasCssClass('current');
  }

  public function disable($disabled = true) {
    if ($disabled) {
      $this->cssClasses()->set('disabled');
    } else {
      $this->cssClasses()->remove('disabled');
    }
    return $this;
  }

  public function isEnabled() {
    return !$this->cssClasses()->contains('disabled');
  }

}
