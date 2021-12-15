<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Navigation;

use Sphp\Foundation\Sites\Core\FoundationSettings;
use Sphp\Foundation\Sites\Core\JavaScript\JavaScriptComponent;
use Sphp\Stdlib\Strings;

/**
 * Description of ResponsiveMenu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ResponsiveMenu extends AbstractMenu implements JavaScriptComponent {

  /**
   * @var FoundationSettings 
   */
  private $settings;

  /**
   * Constructor
   * 
   * @param FoundationSettings $settings
   */
  public function __construct(FoundationSettings $settings = null) {
    parent::__construct();
    if ($settings === null) {
      $settings = FoundationSettings::default();
    }
    $this->settings = $settings;
  }

  public function __destruct() {
    unset($this->settings);
    parent::__destruct();
  }

  public function setOption(string $name, $value) {
    if (is_bool($value)) {
      $value = $value ? 'true' : 'false';
    }
    $dataAttrName = preg_replace('/([A-Z])/', '-$1', $name);
    //echo strtolower($dataAttrName);
    if (!Strings::startsWith($dataAttrName, 'data-')) {
      $dataAttrName = "data-$dataAttrName";
    }
    $this->setAttribute(strtolower($dataAttrName), $value);
    return $this;
  }

  public function setDefaultrOrientation(string $orientation) {
    if ($orientation === OptionsMenu::VERTICAL) {
      $this->cssClasses()->add('vertical');
    } else if ($orientation === OptionsMenu::HORIZONTAL) {
      $this->cssClasses()->remove('vertical');
    }
    return $this;
  }

  public function setOrientationFor(string $screenSize, string $orientation) {
    $this->unsetResponsiveOrientations();
    $this->cssClasses()->add("$screenSize-$orientation");
    return $this;
  }

  /**
   * Unsets the Cell width associated with the given screen size
   *
   * @return $this for a fluent interface
   */
  public function unsetResponsiveOrientations() {
    $screens = implode('|', $this->settings->getScreenSizes());
    $this->cssClasses()->removePattern("/^($screens)-(vertical|horizontal)$/");
    return $this;
  }

  public function setDefaultType(string $defaultType, $screenSize, $type) {
    $this->setAttribute('data-responsive-menu', "$defaultType $screenSize-$type");
    return $this;
  }

  /**
   * 
   * @param  string $screenSize
   * @return ResponsiveMenu new menu object
   */
  public static function drilldownAccordion(string $screenSize = 'medium'): ResponsiveMenu {
    $menu = new static();
    $menu->setDefaultrOrientation(OptionsMenu::VERTICAL)->setOrientationFor($screenSize, OptionsMenu::HORIZONTAL);
    $menu->setDefaultType(OptionsMenu::DRILLDOWN, $screenSize, OptionsMenu::ACCORDION);
    return $menu;
  }

  /**
   * 
   * @param  string $screenSize
   * @return ResponsiveMenu new menu object
   */
  public static function accordionDropdown(string $screenSize = 'medium'): ResponsiveMenu {
    $menu = new static();
    $menu->setDefaultrOrientation(OptionsMenu::VERTICAL)->setOrientationFor($screenSize, OptionsMenu::HORIZONTAL);
    $menu->setDefaultType(OptionsMenu::ACCORDION, $screenSize, OptionsMenu::DROPDOWN);
    return $menu;
  }

  /**
   * 
   * @param  string $screenSize
   * @return ResponsiveMenu new menu object
   */
  public static function drilldownDropdown(string $screenSize = 'medium'): ResponsiveMenu {
    $menu = new static();
    $menu->setDefaultrOrientation(OptionsMenu::VERTICAL)->setOrientationFor($screenSize, OptionsMenu::HORIZONTAL);
    $menu->setDefaultType(OptionsMenu::DRILLDOWN, $screenSize, OptionsMenu::DROPDOWN);
    return $menu;
  }

}
