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
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
 class BarContentArea extends SimpleContainerTag implements BarContentAreaInterface {

  /**
   * Constructs a new instance
   *
   * @param string $tagname the title of the Top Bar component
   */
  public function __construct(string $tagname = 'div') {
    parent::__construct($tagname);
  }
}
