<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Lists\HyperlinkListItem;

/**
 * Implements an accessible menu item for a Breadcrumb component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/breadcrumbs.html Foundation Breadcrumbs
 * @link    http://www.w3schools.com/tags/tag_a.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class BreadCrumb extends HyperlinkListItem {

  /**
   * Sets or unsets the hyperlink component as active
   *
   * @param  boolean $active true for activation and false for deactivation
   * @return $this for a fluent interface
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
