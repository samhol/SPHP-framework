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

use Sphp\Html\SimpleTag;

/**
 * Implementation of an HTML option tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_option.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Option extends SimpleTag implements MenuComponent {

  /**
   * Constructor
   *
   * @param string|int|float|null $value value attribute
   * @param string|int|float|null $content the content text of the option
   * @link  https://www.w3schools.com/tags/att_option_value.asp value attribute
   */
  public function __construct(string|int|float|null $value = null, string|int|float|null $content = null) {
    parent::__construct('option');
    if ($value !== null) {
      $this->setValue($value);
    }
    $this->setContent($content);
  }

  /**
   * Returns the value of the value attribute
   *
   * @return  string|int|float|null the value of the value attribute
   * @link    https://www.w3schools.com/tags/att_option_value.asp value attribute
   */
  public function getValue():string|int|float|null {
    return $this->attributes()->getValue('value');
  }

  /**
   * Sets the value of the value attribute
   *
   * @param  string|int|float|null $value the value of the value attribute
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_option_value.asp value attribute
   */
  public function setValue(string|int|float|null $value) {
    $this->attributes()->setAttribute('value', $value);
    return $this;
  }

  /**
   * Sets the option as selected or not
   *
   * @param  bool $selected true if the option is selected, otherwise false
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_option_selected.asp selected attribute
   */
  public function setSelected(bool $selected = true) {
    $this->attributes()->setAttribute('selected', $selected);
    return $this;
  }

  /**
   * Checks whether the option is selected or not
   *
   * @return bool true if the option is selected, false otherwise
   * @link   https://www.w3schools.com/tags/att_option_selected.asp selected attribute
   */
  public function isSelected(): bool {
    return $this->attributes()->isVisible('selected') && $this->isEnabled();
  }

  public function disable(bool $disabled = true) {
    $this->attributes()->setAttribute('disabled', $disabled);
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->isVisible('disabled');
  }

}
