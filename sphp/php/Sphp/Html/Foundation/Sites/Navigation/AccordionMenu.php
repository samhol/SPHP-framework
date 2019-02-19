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
 * Implements an Accordion menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/sidenav.html Foundation Side Nav
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class AccordionMenu extends BasicMenu {

  /**
   * Constructor
   *
   * @param null|string|Heading $content the top most heading of the Foundation Side Nav
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->cssClasses()->protectValue('vertical accordion-menu');
    $this->attributes()->demand('data-accordion-menu');
  }

  public function append(MenuItem $content) {
    if ($content instanceof SubMenu) {
      $content->setVertical(true);
    }
    parent::append($content);
    return $this;
  }

}
