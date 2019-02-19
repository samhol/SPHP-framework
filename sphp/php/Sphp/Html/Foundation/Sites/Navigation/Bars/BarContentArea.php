<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\SimpleTag;

/**
 * Implements an abstract Bar content area
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
 class BarContentArea extends SimpleTag implements BarContentAreaInterface {

  /**
   * Constructor
   *
   * @param string $tagname the title of the Top Bar component
   */
  public function __construct(string $tagname = 'div') {
    parent::__construct($tagname);
  }
}
