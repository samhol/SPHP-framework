<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Html\TraversableContent;

/**
 * Implements an HTML &lt;select&gt; tag
 *
 * The &lt;select&gt; element is used to create a drop-down list. The
 * &lt;option&gt; tags inside the &lt;select&gt; element define the available
 * options in the list.
 *
 * **Notes:**
 *
 * * Nesting {@link Optgroup} in a {@link self} menu: nested menus are currently 
 *   not supported in most web browsers. However future versions of HTML may extend the 
 *   grouping mechanism to allow for nested groups (i.e., {@link Optgroup} components may 
 *   nest). This will allow authors to represent a richer hierarchy of choices.
 * * Because of the above nesting of {@link Optgroup} objects is supported
 *   but not recommended.
 * * The {@link Select} component is a form control and can be used in a 
 *   form to collect user input.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_select.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Select extends AbstractOptionsContainer implements SelectMenuInterface {

  /**
   * Constructor
   *
   * **`$opt` types:**
   * 
   * 1. a {@link SelectContentInterface} is stored as such
   * 2. a single dimensional array with $key => $val pairs corresponds to an 
   *    array of new {@link Option}($key, $val) objects
   * 3. a multidimensional array corresponds to a multidimensional menu structure with 
   *    {@link Optgroup} components containing new {@link Option}($key, $val) objects
   * 
   * @param string|null $name name attribute
   * @param MenuComponent|mixed[] $opt the content of the menu
   * @param string|string[] $selectedValues the option values selected
   */
  public function __construct(string $name = null, $opt = null, $selectedValues = null) {
    parent::__construct('select', $opt);
    if (isset($name)) {
      $this->setName($name);
    }
    if ($selectedValues !== null) {
      $this->setSelectedValues($selectedValues);
    }
  }

  public function getOptions(): TraversableContent {
    return $this->getComponentsByObjectType(Option::class);
  }

  public function getSelectedOptions(): TraversableContent {
    $isSelected = function($component) {
      if ($component instanceof Option) {
        return $component->isSelected();
      } else {
        return false;
      }
    };
    return $this->getComponentsBy($isSelected);
  }

  public function setSelectedValues($selectedValues) {
    if (!is_array($selectedValues)) {
      $selectedValues = array($selectedValues);
    }
    foreach ($this->getOptions() as $option) {
      if (in_array($option->getValue(), $selectedValues)) {
        $option->setSelected(true);
      } else if ($option->isSelected()) {
        $option->setSelected(false);
      }
    }
    return $this;
  }

  public function getSubmitValue() {
    $selected = [];
    foreach ($this->getSelectedOptions() as $option) {
      $selected[] = $option->getValue();
    }
    return array_unique($selected);
  }

  public function setInitialValue($value) {
    return $this->setSelectedValues($value);
  }

  public function selectMultiple(bool $multiple = true) {
    $this->attributes()->setAttribute('multiple', $multiple);
    return $this;
  }

  public function setSize(int $size = null) {
    $this->attributes()->setAttribute('size', $size);
    return $this;
  }

  public function setRequired(bool $required = true) {
    $this->attributes()->required($required);
    return $this;
  }

  public function isRequired(): bool {
    return $this->attributeExists('required');
  }

  public function getName(): string {
    return (string) $this->attributes()->getValue('name');
  }

  public function setName(string $name = null) {
    $this->attributes()->setAttribute('name', $name);
    return $this;
  }

  public function isNamed(): bool {
    return $this->attributes()->isVisible('name');
  }

  public function disable(bool $disabled = true) {
    $this->attributes()->disabled = $disabled;
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->isVisible('disabled');
  }

  public static function from(string $name = null, array $opt = null): Select {
    
    return new Select($name, $opt);
  }

}
