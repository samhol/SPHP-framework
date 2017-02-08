<?php

/**
 * AbstractBarContentArea.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\SimpleContainerTag;

/**
 * Implements an abstract Bar content area
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-21
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
 class BarContentArea extends SimpleContainerTag implements BarContentAreaInterface {

  /**
   * Constructs a new instance
   *
   * @param string $tagname the title of the Top Bar component
   */
  public function __construct($tagname) {
    parent::__construct($tagname);
  }

}
