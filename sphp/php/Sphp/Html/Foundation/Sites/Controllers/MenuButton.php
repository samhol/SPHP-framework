<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Controllers;

use Sphp\Html\EmptyTag;

/**
 * Class MenuOpenerButton
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class MenuButton extends EmptyTag {

  /**
   * Constructor
   */
  public function __construct(string $screenreadertext = null) {
    parent::__construct('button', true);
    $this->cssClasses()->protectValue('menu-icon');
    $this->attributes()->setAria('label', $screenreadertext);
  }

  public function setTarget($target) {
    if ($target instanceof \Sphp\Html\IdentifiableContent) {
      $target = $target->identify();
    }
    $this->attributes()->setAttribute('data-toggle', $target);
  }

}
