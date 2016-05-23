<?php

/**
 * AttributeChanger.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

/**
 * Interface defines the an HTML attribute changer
 *
 * {@link self} implements the subject part of the Observer Design Pattern.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @version 2.0.1
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface AttributeChanger {

  /**
   * Attaches an observer so that it can be notified of attribute updates
   *
   * @param  callable|AttributeChangeObserver $observer
   * @return self for PHP Method Chaining
   */
  public function attachAttributeChangeObserver($observer);

  /**
   * Detaches an observer from the subject to no longer notify it of attribute updates
   *
   * @param  callable|AttributeChangeObserver $observer
   * @return self for PHP Method Chaining
   */
  public function detachAttributeChangeObserver($observer);

  /**
   * Notifies all attached attribute observers
   *
   * @return self for PHP Method Chaining
   */
  public function notifyAttributeChange($attrName);
}
