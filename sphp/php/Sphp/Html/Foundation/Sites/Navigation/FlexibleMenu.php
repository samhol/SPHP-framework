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
 * Implements a basic navigation menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/menu.html Foundation Menu
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FlexibleMenu extends AbstractMenu {

  /**
   * Constructor
   *
   * @param mixed $content
   */
  public function __construct($content = null) {
    parent::__construct('ul');
    if ($content !== null) {
      $this->appendContent($content);
    }
  }

  /**
   * 
   * @param mixed $content
   */
  protected function appendContent($content) {
    foreach (is_array($content) ? $content : [$content] as $item) {
      if ($item instanceof MenuItem) {
        $this->append($item);
      } else {
        $this->appendText($item);
      }
    }
  }

  /**
   * Creates a new Accordion down menu 
   * 
   * @return FlexibleMenu
   */
  public static function createAccordion(): FlexibleMenu {
    $menu = new static();
    $menu->cssClasses()->protectValue('accordion-menu');
    $menu->setVertical(true);
    $menu->attributes()->demand('data-accordion-menu');
    return $menu;
  }

  /**
   * Creates a new Drill down menu 
   * 
   * @return FlexibleMenu
   */
  public static function createDrilldown(): FlexibleMenu {
    $menu = new static();
    $menu->attributes()->demand('data-drilldown');
    $menu->setVertical(true);
    $menu->cssClasses()->protectValue('drilldown');
    return $menu;
  }

  /**
   * Creates a new Drop down menu 
   * 
   * @return FlexibleMenu
   */
  public static function createDropdown(): FlexibleMenu {
    $menu = new static();
    $menu->cssClasses()->protectValue('dropdown');
    $menu->attributes()->demand('data-dropdown-menu');
    return $menu;
  }

}
