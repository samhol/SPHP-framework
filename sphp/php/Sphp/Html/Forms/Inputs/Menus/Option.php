<?php

/**
 * Option.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Html\SimpleContainerTag as SimpleContainerTag;

/**
 * Implements an HTML &lt;option&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_option.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Option extends SimpleContainerTag implements SelectMenuContentInterface {

  /**
   * Constructs a new instance
   *
   * @param scalar|null $value value attribute
   * @param scalar|null $content the content text of the option
   * @param boolean $selected whether option is selected or not
   * @link  http://www.w3schools.com/tags/att_option_value.asp value attribute
   * @link  http://www.w3schools.com/tags/att_option_selected.asp selected attribute
   */
  public function __construct($value = null, $content = null, bool $selected = false) {
    parent::__construct('option', $content);
    if ($value !== null) {
      $this->setValue($value);
    }
    $this->setSelected($selected);
  }

  /**
   * Returns the value of the value attribute
   *
   * @return  string the value of the value attribute
   * @link    http://www.w3schools.com/tags/att_option_value.asp value attribute
   */
  public function getValue() {
    return $this->attrs()->getValue('value');
  }

  /**
   * Sets the value of the value attribute
   *
   * @param  string $value the value of the value attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_option_value.asp value attribute
   */
  public function setValue($value) {
    $this->attrs()->set('value', $value);
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
    $this->attrs()->set('selected', $selected);
  }

  /**
   * Checks whether the option is selected or not
   *
   * @return boolean true if the option is selected, false otherwise
   * @link   http://www.w3schools.com/tags/att_option_selected.asp selected attribute
   */
  public function isSelected(): bool {
    return $this->attrs()->exists('selected') && $this->isEnabled();
  }

  /**
   * Disables or enables the option object
   *
   * @param  boolean $enabled true if the option is enabled, otherwise false
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_option_disabled.asp disabled attribute
   */
  public function setEnabled(bool $enabled = true) {
    $this->attrs()->set('disabled', !$enabled);
    return $this;
  }

  /**
   * Checks whether the option is enabled or not
   * 
   * @param  boolean true if the option is enabled, otherwise false
   */
  public function isEnabled(): bool {
    return !$this->attrs()->exists('disabled');
  }

}
