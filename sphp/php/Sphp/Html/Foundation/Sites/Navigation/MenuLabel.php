<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\ContainerTag;

/**
 * Implements a simple section separator line for Foundation menu structures
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @link    http://foundation.zurb.com/docs/components/sidenav.html Foundation Side Nav
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MenuLabel extends ContainerTag implements MenuItem {

  /**
   * Constructor
   * 
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * PHP string or to an array of PHP strings. So also an object of any class 
   * that implements magic method `__toString()` is allowed.
   * 
   * @param  mixed $content the content of the label
   */
  public function __construct($content = null) {
    parent::__construct('li');
    $this->cssClasses()->protectValue('menu-text');
    $this->append($content);
  }

}
