<?php

/**
 * BreadCrumb.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Class Models an accessible menu item for Foundation 6 Breadcrumb component
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/breadcrumbs.html Foundation 6 Breadcrumbs
 * @link    http://www.w3schools.com/tags/tag_a.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BreadCrumb extends MenuLink {

  /**
   * Sets or unsets the hyperlink component as active
   *
   * @param  boolean $active true foor activation and false for deactivation
   * @return self for PHP Method Chaining
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
   * Checks whether the hyperlink component is set as active or not
   *
   * @return boolean true if the hyperlink component is set as active,
   *         otherwise false
   */
  public function isDisabled() {
    return $this->hasCssClass('disabled');
  }

}
