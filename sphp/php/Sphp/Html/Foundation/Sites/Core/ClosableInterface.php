<?php

/**
 * ClosableInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Core;

/**
 * Defines a closable component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/close-button.html Foundation Close Button
 * @link    http://foundation.zurb.com/sites/docs/close-button.html#making-closable Foundation - Making Closable
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ClosableInterface {

  /**
   * Sets/unsets the component closable
   * 
   * Values for `$closable` parameter
   * 
   * * `true`: the component is closable and the default closing effect is used 
   * * `'slide-out-right'`
   * * ...any other Foundation Motion UI effect string
   * * `false`: the component is not closable
   * 
   * @param  string|boolean $closable true for closable and false otherwise
   * @return self for a fluent interface
   */
  public function setClosable(bool $closable = true);

  /**
   * Checks whether the component is  set as closable or not
   * 
   * @return boolean true if closable and false if not
   */
  public function isClosable(): bool;
}
