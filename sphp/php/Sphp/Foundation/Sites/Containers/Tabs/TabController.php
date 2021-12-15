<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Containers\Tabs;

use Sphp\Html\Lists\StandardListItem;

/**
 * Defines a Tab controller for Tabs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface TabController extends StandardListItem {

  /**
   * Sets the Tab controller active/inactive
   * 
   * @param  bool $active true for active and false for inactive
   * @return $this for a fluent interface
   */
  public function setActive(bool $active = true);
}
