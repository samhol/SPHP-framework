<?php

/**
 * PageInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

use Sphp\Html\ComponentInterface;
use Sphp\Html\Navigation\HyperlinkInterface;
use Sphp\Html\Lists\LiInterface;

/**
 * Defines a page button for a Pagination component
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/pagination.html Foundation Pagination
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface PageInterface extends ComponentInterface, HyperlinkInterface, LiInterface {
  
  /**
   * Sets the content of the component
   * 
   * @param  mixed $content the content of the component
   * @return $this for a fluent interface
   */
  public function setContent($content);

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
  public function isCurrent(): bool ;
  
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
   * @param  boolean true if the component is enabled, otherwise false
   */
  public function isEnabled(): bool;
}
