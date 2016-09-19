<?php

/**
 * IdentityChanger.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

/**
 * Interface defines the an HTML identity changer
 *
 * {@link self} implements the subject part of the Observer Design Pattern.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface IdentityChanger {

  /**
   * Attaches an observer so that it can be notified of identity changes
   *
   * @param  callable|IdentityObserver $observer
   * @return self for PHP Method Chaining
   */
  public function attachIdentityObserver($observer, $identityName = "id");

  /**
   * Detaches an observer from the subject to no longer notify it of identity changes
   *
   * @param  callable|IdentityObserver $observer
   * @return self for PHP Method Chaining
   */
  public function detachIdentityObserver($observer, $identityName = "id");
  
  
}
