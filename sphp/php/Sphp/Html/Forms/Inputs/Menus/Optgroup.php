<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implementation of an HTML optgroup tag

 * **Notes:**
 *
 * **Nesting optgroups in a select menu:** The HTML spec here is broken. It
 * should allow nested optgroups and recommend user agents render them as
 * nested menus. Instead, only one optgroup level is allowed. However
 * Implementors are advised that future versions of HTML may extend the grouping
 *  mechanism to allow for nested groups (i.e., OPTGROUP elements may nest).
 * This will allow authors to represent a richer hierarchy of choices.
 *
 * Because of the above nesting of optgroup elements is supported but not
 * recommended.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_optgroup.asp w3schools HTML API
 * @filesource
 */
class Optgroup extends AbstractOptions implements MenuComponent {

  /**
   * Constructor
   *  
   * @param string|null $label specifies a label for an option-group
   * @param iterable|null $data the data content
   */
  public function __construct(?string $label = null, ?iterable $data = null) {
    parent::__construct('optgroup');
    if ($label !== null) {
      $this->setLabel($label);
    }
    if ($data !== null) {
      $this->appendOptions($data);
    }
  }

  /**
   * Appends menu components from iterable 
   * 
   * <code>$options</code> with <code>$key => $val</code> pairs:
   * 
   * 1. an {@see Option} <code>$val</code> is stored as such
   * 2. a scalar <code>$val</code> is stored as an {@see Option}($key, $val)
   * 3. all other data results to an exception thrown
   * 
   * @param  iterable<string|int, scalar|MenuComponent> $options
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the iteable contains invalid data
   * @see    Option
   */
  public function appendOptions(iterable $options) {
    foreach ($options as $index => $option) {
      if ($option instanceof Option) {
        $this->append($option);
      } else if (is_scalar($option) || is_null($option)) {
        $this->appendOption($index, (string) $option);
      } else {
        throw new InvalidArgumentException('Invalid option data at ' . $index);
      }
    }
    return $this;
  }

  /**
   * Sets the label for the group
   *
   * @param  string $label the label for the group
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_optgroup_label.asp label attribute
   */
  public function setLabel(?string $label) {
    $this->attributes()->setAttribute('label', $label);
    return $this;
  }

  public function disable(bool $disabled = true) {
    $this->attributes()->setAttribute('disabled', $disabled);
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->isVisible('disabled');
  }

}
