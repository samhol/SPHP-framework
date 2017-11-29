<?php

/**
 * VisibilityAdapter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\CssClassifiableContent;
use Sphp\Stdlib\Arrays;

/**
 * Implements Visibility changer functionality
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class VisibilityAdapter extends AbstractLayoutManager implements VisibilityChanger {

  use VisibilityTrait;

  /**
   * Constructs a new instance
   * 
   * @param ComponentInterface $component
   */
  public function __construct(CssClassifiableContent $component) {
    parent::__construct($component);
  }

  public function setLayouts(...$layouts) {
    
  }

  public function unsetLayouts() {
    $this->showForAll();
    return $this;
  }

}
