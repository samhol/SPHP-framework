<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\AbstractComponent;

/**
 * Class MenuOpenerButton
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class MenuButton extends AbstractComponent {

  /**
   * 
   * @param OffCanvasAreaInterface $offCanvas the off-canvas component or its id
   * @param string $screenReaderText
   */
  public function __construct() {
    parent::__construct('button');
    $this->cssClasses()->protect('menu-icon');
  }

  public function contentToString(): string {
    return '';
  }

}
