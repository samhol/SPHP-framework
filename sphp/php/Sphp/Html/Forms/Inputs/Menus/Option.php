<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Html\SimpleTag;

/**
 * option tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_option.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Option extends SimpleTag implements MenuComponent {

  /**
   * Constructor
   *
   * @param scalar|null $value value attribute
   * @param string|null $content the content text of the option
   * @link  http://www.w3schools.com/tags/att_option_value.asp value attribute
   */
  public function __construct($value = null, string $content = null) {
    parent::__construct('option');
    if ($value !== null) {
      $this->setValue($value);
    }
    $this->setContent($content);
  }

  /**
   * Returns the value of the value attribute
   *
   * @return  string the value of the value attribute
   * @link    http://www.w3schools.com/tags/att_option_value.asp value attribute
   */
  public function getValue() {
    return $this->attributes()->getValue('value');
  }

  /**
   * Sets the value of the value attribute
   *
   * @param  string $value the value of the value attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_option_value.asp value attribute
   */
  public function setValue($value) {
    $this->attributes()->setAttribute('value', $value);
    return $this;
  }

  /**
   * Sets the option as selected or not
   *
   * @param  boolean $selected true if the option is selected, otherwise false
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_option_selected.asp selected attribute
   */
  public function setSelected(bool $selected = true) {
    $this->attributes()->setAttribute('selected', $selected);
    return $this;
  }

  /**
   * Checks whether the option is selected or not
   *
   * @return boolean true if the option is selected, false otherwise
   * @link   http://www.w3schools.com/tags/att_option_selected.asp selected attribute
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
