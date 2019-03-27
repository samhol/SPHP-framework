<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Attributes\PropertyCollectionAttribute;
use Sphp\Html\Foundation\Sites\Core\JavaScript\JavaScriptComponent;
/**
 * Implements a flexible navigation menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/menu.html Foundation Menu
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FlexibleMenu extends AbstractMenu implements JavaScriptComponent {

  /**
   * @var PropertyCollectionAttribute 
   */
  private $options;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
    $this->attributes()->setInstance($this->options = new PropertyCollectionAttribute('data-options'));
  }

  public function __destruct() {
    unset($this->options);
    parent::__destruct();
  }

  public function __clone() {
    $this->options = $this->attributes()->getObject('data-options');
    parent::__clone();
  }

  public function setOption(string $name, $value) {
    if (is_bool($value)) {
      $value = $value ? 'true' : 'false';
    }
    $this->options->setProperty($name, $value);
    return $this;
  }

  /**
   * 
   * @return $this
   */
  public function resetLayout() {
    $this->removeCssClass('accordion-menu', 'drilldown', 'dropdown');
    $this->setAttribute('data-accordion-menu', false);
    $this->setAttribute('data-dropdown-menu', false);
    $this->setAttribute('data-drilldown', false);
    $this->setVertical(false);
    return $this;
  }

  /**
   * 
   * @param  string|null $menuType
   * @return $this
   */
  public function setLayout(string $menuType = null) {
    $this->resetLayout();
    if ($menuType === self::ACCORDION) {
      $this->addCssClass('accordion-menu');
      $this->setVertical(true);
      $this->setAttribute('data-accordion-menu', true);
    } else if ($menuType === self::DROPDOWN) {
      $this->addCssClass('dropdown');
      $this->setAttribute('data-dropdown-menu', true);
    } else if ($menuType === self::DRILLDOWN) {
      $this->addCssClass('drilldown');
      $this->setVertical(true);
      $this->setAttribute('data-drilldown', true);
    }
    return $this;
  }

  /**
   * Creates a new Accordion down menu 
   * 
   * @return FlexibleMenu
   */
  public static function createAccordion(): FlexibleMenu {
    $menu = new static();
    $menu->setLayout(self::ACCORDION);
    return $menu;
  }

  /**
   * Creates a new Drill down menu 
   * 
   * @return FlexibleMenu
   */
  public static function createDrilldown(bool $autoHeight = false, bool $outoHeight = false): FlexibleMenu {
    $menu = new static();
    $menu->setLayout(self::DRILLDOWN);
    // data-auto-height="true"
    return $menu;
  }

  /**
   * Creates a new Drop down menu 
   * 
   * @return FlexibleMenu
   */
  public static function createDropdown(): FlexibleMenu {
    $menu = new static();
    $menu->setLayout(self::DROPDOWN);
    return $menu;
  }

}
