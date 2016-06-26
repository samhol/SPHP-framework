<?php

/**
 * PageTrait.php (UTF-8)
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
trait PageTrait {

  /**
   * Sets the hyperlink component as active if the URL matches with the 
   *  current URL of the page
   * 
   * @return PageInterface for PHP Method Chaining
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
   * @return PageInterface for PHP Method Chaining
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
   * Disables the pagination component
   * 
   * A disabled pagination component is unusable and un-clickable. 
   *
   * @param  boolean $disabled true if the component is disabled, otherwise false
   * @return PageInterface for PHP Method Chaining
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
   * Checks whether the pagination component is enabled or not
   * 
   * @param  boolean true if the component is enabled, otherwise false
   */
  public function isEnabled() {
    return !$this->cssClasses()->contains("disabled");
  }

}
