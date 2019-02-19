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
 * Implements a Drill down menu 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DrilldownMenu extends BasicMenu {

  /**
   * Constructor
   *
   * @param mixed $content
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->setVertical(true);
    $this->attributes()->demand('data-drilldown');
  }

  public function append(MenuItem $content) {
    if ($content instanceof SubMenu) {
      $content->setVertical(true);
    }
    parent::append($content);
    return $this;
  }

}
