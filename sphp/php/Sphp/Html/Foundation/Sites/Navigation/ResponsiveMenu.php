<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use \Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Foundation\Sites\Core\FoundationSettings;

/**
 * Description of ResponsiveMenu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ResponsiveMenu extends AbstractMenu {

  /**
   * Constructor
   * 
   * @param string $tagName
   * @param FoundationSettings $settings
   */
  public function __construct(FoundationSettings $settings = null) {
    parent::__construct();
    if ($settings === null) {
      $settings = FoundationSettings::default();
    }
    $this->settings = $settings;
  }

  public function setDefaultrOrientation(string $orientation) {
    if ($orientation === Menu::VERTICAL) {
      $this->cssClasses()->add('vertical');
    } else if ($orientation === Menu::HORIZONTAL) {
      $this->cssClasses()->remove('vertical');
    }
    return $this;
  }

  public function setOrientationFor(string $orientation, string $screenSize) {
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
    $this->cssClasses()->removePattern("/^(($screens)-|vertical|horizontal))$/");
    return $this;
  }

}
