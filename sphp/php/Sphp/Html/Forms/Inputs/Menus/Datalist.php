<?php

/**
 * Datalist.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
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
