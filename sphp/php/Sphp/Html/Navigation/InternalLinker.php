<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\Component;

/**
 * Description of InternalLinker
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InternalLinker extends \Sphp\Html\Adapters\AbstractComponentAdapter {

  /**
   * Constructor
   * 
   * @param Component $component
   * @param string|null $id the id to use
   */
  public function __construct(Component $component, string $id = null) {
    parent::__construct($component);
    $this->getComponent()->setAttribute('id', $id);

  }

}
