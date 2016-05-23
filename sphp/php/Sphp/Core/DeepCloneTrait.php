<?php

/**
 * FlorianWolters\Component\Core\DeepCloneTrait
 *
 * PHP Version 5.4
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2011-2014 Florian Wolters (http://blog.florianwolters.de)
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Core-Cloneable
 */

namespace Sphp\Core;

use Exception;

/**
 * A class uses the {@see DeepCloneTrait} to indicate to the magic `__clone`
 * method of a class that it is **legal** for that method to make a **deep*
 * field-for-field copy of instances of that class.
 *
 * @since Trait available since Release 0.2.0
 */
trait DeepCloneTrait {

  /**
   * Creates a copy of this object.
   *
   * "copy" means performing a **deep** copy of all of the properties of this
   * object.
   *
   * @return void
   * @throws CloneNotSupportedException If the object using this trait does
   *    not implement {@see CloneableInterface}.
   * @throws CloneNotSupportedException If an object property of the object
   *    using this trait does not implement {@see CloneableInterface}.
   */
  final public function __clone() {
    try {
      if (is_callable('parent::__clone')) {
        parent::__clone();
      }
      foreach ($this as $key => $value) {
        if (is_object($value)) {
          //CloneUtils::throwCloneNotSupportedExceptionIfNotCloneable($value);
          // Detect possible self-reference.
          if ($this == $value) {
            $this->{$key} = &$this;
          } else {
            $this->{$key} = clone $value;
          }
        } else if (is_array($value)) {
          array_walk_recursive($value, function (&$element) {
            //CloneUtils::throwCloneNotSupportedExceptionIfNotCloneable($element);
            // Detect possible self-reference.
            if ($this == $element) {
              $element = &$this;
            } else if (true) {
              
            
              $element = CloneUtils::copy($element);
            }
          }
          );
          $this->{$key} = $value;
        }
      }
    } catch (Exception $e) {
      throw new CloneNotSupportedException(
      'The object does not implement ' . __NAMESPACE__
      . '\CloneableInterface.', $e);
    }
  }

}
