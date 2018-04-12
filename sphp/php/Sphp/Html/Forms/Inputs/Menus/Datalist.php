<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Menus;

/**
 * Description of Datalist
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-12-27
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Datalist extends AbstractOptionsContainer {

  /**
   * Constructs a new instance
   * 
   * @param type $opt
   */
  public function __construct($opt = null) {
    parent::__construct('datalist', $opt);
  }

}
