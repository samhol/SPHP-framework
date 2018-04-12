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
 * Class MagellanMenu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class MagellanMenu extends Menu {

  /**
   * Constructs a new instance
   *
   * @param mixed $content
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->attributes()->demand('data-magellan');
  }

}
