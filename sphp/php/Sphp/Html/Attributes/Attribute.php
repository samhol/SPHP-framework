<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Stringable;

/**
 * Interface AttributeInterface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface Attribute extends Stringable {

  /**
   * Returns the instance of the object as a string
   *
   * @return string the object as a string
   */
  public function __toString(): string;

  /**
   * Returns the name of the attribute 
   * 
   * @return string the name of the attribute
   */
  public function getName(): string;

  /**
   * Returns the value of the attribute
   * 
   * **IMPORTANT:**
   * 
   * * Returns always `boolean false` if attribute is not present.
   * * return `null` or an empty string for empty attributes.
   * 
   * @return null|bool|int|float|string the value of the attribute
   */
  public function getValue();

  /**
   * Checks whether the attribute is visible or not
   * 
   * **Note:** an attribute is visible if it has locked value or the attribute 
   * name is required or the attribute value is not boolean (false).
   * 
   * @return bool true if the attribute is visible and false otherwise
   */
  public function isVisible(): bool;

  /**
   * Checks whether the attribute is always visible or not
   * 
   * **Note:** a visible attribute has atleast its name visible
   *
   * @return bool true if the attribute is always and false otherwise
   */
  public function isAlwaysVisible(): bool;

  /**
   * Checks whether the attribute is empty or not
   * 
   * **Note:** an attribute is visible if it has locked value or the attribute 
   * name is required or the attribute value is not boolean (false).
   * 
   * @return bool true if the attribute is empty and false otherwise
   */
  public function isEmpty(): bool;
}
