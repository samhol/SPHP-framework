<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Implements a Dropown menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DropdownMenu extends Menu {

  /**
   * Constructor
   *
   * @param mixed $content
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->cssClasses()->protectValue('dropdown');
    $this->attributes()->demand('data-dropdown-menu');
  }

  public function append(MenuItem $content) {
    if ($content instanceof SubMenu) {
      $content->addCssClass('sphp-hide-fouc-on-load');
    }
    parent::append($content);
    return $this;
  }

}
