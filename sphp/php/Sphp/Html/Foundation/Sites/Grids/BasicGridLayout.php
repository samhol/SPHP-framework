<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Foundation\Sites\Core\AbstractLayoutManager;
use Sphp\Html\CssClassifiableContent;

/**
 * Implements a layout object for a XY Grid (Row container)
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BasicGridLayout extends AbstractLayoutManager implements GridLayout {

  /**
   * Constructor
   * 
   * @param CssClassifiableContent $component
   */
  public function __construct(CssClassifiableContent $component) {
    parent::__construct($component);
    $this->cssClasses()->protectValue('grid-container');
  }

  public function setFluid(bool $fluid = false) {
    if ($fluid) {
      $this->cssClasses()->remove('full')->add('fluid');
    } else {
      $this->cssClasses()->remove('fluid');
    }
    return $this;
  }

  public function setFull(bool $full = false) {
    if ($full) {
      $this->cssClasses()->remove('fluid')->add('full');
    } else {
      $this->cssClasses()->remove('full');
    }
    return $this;
  }

  public function setLayouts(...$layouts) {
    $this->cssClasses()->add($layouts);
    $this->cssClasses()->add('grid-container');
    return $this;
  }

  public function unsetLayouts() {
    $this->setFluid(false)->setFull(false);
    return $this;
  }

}
