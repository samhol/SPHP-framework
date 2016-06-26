<?php

/**
 * Page.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Navigation\Pagination;

use Sphp\Html\Lists\HyperlinkListItem as HyperlinkListItem;
use Sphp\Net\URL as URL;

/**
 * Class Models a page button for Foundation Pagination component
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/pagination.html Foundation Pagination
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Page extends HyperlinkListItem implements PageInterface {

  /**
   * Constructs a new instance
   *
   * **Notes:**
   * 
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   * * If the $content is empty, the $href is also the content of the object.
   *
   * @param  int $index the index of the page
   * @param  string|URL $href the URL of the link
   * @param  string $target optional value of the target attribute
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($content = null, $href = null, $target = "_self") {
    parent::__construct($href, $content, $target);
  }

  /**
   * Sets the hyperlink component as active if the URL matches with the 
   *  current URL of the page
   * 
   * @return self for PHP Method Chaining
   */
  public function activate() {
    if ($this->urlEquals(URL::getCurrent())) {
      $this->setCurrent(true);
    } else {
      $this->setCurrent(false);
    }
    return $this;
  }

  /**
   * Sets or unsets the hyperlink component as active
   * 
   * @param  boolean $active true foor activation and false for deactivation
   * @return self for PHP Method Chaining
   */
  public function setCurrent($active = true) {
    if ($active) {
      return $this->addCssClass("current");
    } else {
      return $this->removeCssClass("current");
    }
  }

  /**
   * Checks whether the hyperlink component is set as active or not
   * 
   * @return boolean true if the hyperlink component is set as active, otherwise false
   */
  public function isCurrent() {
    return $this->hasCssClass("current");
  }

  /**
   * {@inheritdoc}
   */
  public function disable($disabled = true) {
    if ($disabled) {
      $this->cssClasses()->set("disabled");
    } else {
      $this->cssClasses()->remove("disabled");
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isEnabled() {
    return !$this->cssClasses()->contains("disabled");
  }

}