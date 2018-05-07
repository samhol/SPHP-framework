<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\CssClassifiableContent;

/**
 * Implements Visibility changer functionality
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class VisibilityAdapter extends AbstractLayoutManager implements VisibilityChanger {

  use VisibilityTrait;

  /**
   * Constructor
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
