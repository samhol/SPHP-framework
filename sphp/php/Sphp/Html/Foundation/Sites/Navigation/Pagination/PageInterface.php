<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

use Sphp\Html\Component;
use Sphp\Html\Navigation\HyperlinkInterface;
use Sphp\Html\Lists\StandardListItem;

/**
 * Defines a page button for a Pagination component
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/pagination.html Foundation Pagination
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface PageInterface extends Component, HyperlinkInterface, StandardListItem {

  /**
   * Sets or unsets the hyperlink component as active
   * 
   * @param  boolean $active true for activation and false for deactivation
   * @return $this for a fluent interface
   */
  public function setCurrent(bool $active = true);

  /**
   * Checks whether the hyperlink component is set as active or not
   * 
   * @return boolean true if the hyperlink component is set as active, otherwise false
   */
  public function isCurrent(): bool;

  /**
   * Disables the pagination component
   * 
   * A disabled pagination component is unusable and un-clickable. 
   *
   * @param  boolean $disabled true if the component is disabled, otherwise false
   * @return $this for a fluent interface
   */
  public function disable(bool $disabled = true);

  /**
   * Checks whether the pagination component is enabled or not
   * 
   * @return boolean true if the component is enabled, otherwise false
   */
  public function isEnabled(): bool;
}
