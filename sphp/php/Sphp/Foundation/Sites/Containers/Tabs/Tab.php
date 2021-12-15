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

use Sphp\Html\IdentifiableContent;

/**
 * Defines a Tab for Tabs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/docs/components/tabs.html Foundation Tabs
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Tab extends IdentifiableContent {

  /**
   * 
   * @return BasicController
   */
  public function getController(): TabController;

  /**
   * Sets or unsets the Tab component as active
   *
   * @param  bool $active true for activation and false for deactivation
   * @return $this for a fluent interface
   */
  public function setActive(bool $active = true);
}
