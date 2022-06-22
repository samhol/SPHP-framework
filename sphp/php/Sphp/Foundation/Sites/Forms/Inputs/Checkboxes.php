<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Forms\Inputs;

/**
 * A component containing multiple {@link Checkbox} inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Checkboxes extends Choiceboxes {

  /**
   * Constructor
   *
   * @param string $name
   * @param array $values
   * @param mixed $legend
   */
  public function __construct(string $name = null, array $values = [], $legend = null) {
    parent::__construct('checkbox', $name, $values, $legend);
  }

  /**
   * Sets the value of name attribute
   *
   * @param  string $name the value of the name attribute
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_input_name.asp name attribute
   */
  public function setName(string $name = null) {
    if (!str_ends_with($name, '[]')) {
      $name .= '[]';
    }
    parent::setName($name);
    return $this;
  }

  /**
   * Returns the value of name attribute
   *
   * @return string the value of the name attribute
   * @link   https://www.w3schools.com/tags/att_input_name.asp name attribute
   */
  public function getName(): ?string {
    $name = parent::getName();
    return str_replace('[]', '', $name);
  }

}
