<?php

/**
 * BreadCrumb.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Implements an accessible menu item for a Breadcrumb component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/breadcrumbs.html Foundation Breadcrumbs
 * @link    http://www.w3schools.com/tags/tag_a.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BreadCrumb extends MenuLink {

  /**
   * Sets or unsets the hyperlink component as active
   *
   * @param  boolean $active true for activation and false for deactivation
   * @return self for a fluent interface
   */
  public function setDisabled($active = true) {
    if ($active) {
      $this->addCssClass('disabled');
    } else {
      $this->removeCssClass('disabled');
    }
    return $this;
  }

  /**
   * Checks whether the hyperlink component is disabled or not
   *
   * @return boolean true if the component is disabled, otherwise false
   */
  public function isDisabled() {
    return $this->hasCssClass('disabled');
  }

}
