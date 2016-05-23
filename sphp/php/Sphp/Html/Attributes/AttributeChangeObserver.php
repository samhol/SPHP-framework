<?php

/**
 * AttributeChangeObserver.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

/**
 * Description of AttributeChangeEvent
 *
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @version 2.0.1
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface AttributeChangeObserver {

  /**
   * Receives an update from an observed subject when an attribute state was changed
   *
   * This method is called when any {@link AttributeChanger} to which the
   * observer is attached calls {@link AttributeChanger::notifyAttributeChange()}.
   *
   * @param  AttributeChanger $obj
   * @param  string $attrName the name of the attribute that was changed
   * @return self for PHP Method Chaining
   */
  public function attributeChanged(AttributeChanger $obj, $attrName);
}
