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
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AccordionMenu extends Menu {

  /**
   * Constructor
   *
   * @param null|string|Heading $content the top most heading of the Foundation Side Nav
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->cssClasses()->protect('vertical accordion-menu');
    $this->attributes()->demand('data-accordion-menu');
  }

  public function append(MenuItemInterface $content) {
    if ($content instanceof SubMenu) {
      $content->vertical(true);
    }
    parent::append($content);
    return $this;
  }

}
