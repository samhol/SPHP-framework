<?php

/**
 * Select.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Menus;

use Sphp\Html\Forms\NonEmptyInputTag as NonEmptyInputTag;
use Sphp\Html\Forms\LabelableInterface as LabelableInterface;
use Sphp\Html\Forms\LabelableTrait as LabelableTrait;

/**
 * Class Models an HTML &lt;select&gt; tag
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
 *   but not recomended.
 * * The {@link Select} component is a form control and can be used in a 
 *   form to collect user input.
 * 
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-03-10
 * @version 2.1.0
 * @link    http://www.w3schools.com/tags/tag_select.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Select extends NonEmptyInputTag implements LabelableInterface {

  use OptionHandlingTrait,
      LabelableTrait;

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "select";

  /**
   * Constructs a new instance of the {@link Select} component
   *
   * <var>$opt</var> parameter:
   * 
   * 1. a {@link SelectContentInterface} is stored as such
   * 2. a single dimensional array with $key => $val pairs corresponds to an 
   *    array of new {@link Option}($key, $val) objects
   * 3. a multidimensional array corresponds to a multidimensional menu structure with 
   *    {@link Optgroup} components containing new {@link Option}($key, $val) objects
   * 4. all other types are converted to strings and and stored as new 
   *    {@link Option}($opt, $opt) object
   *
   * @param  string $name name attribute
   * @param  mixed|mixed[] $opt the content of the menu
   * @param  string|string[] $selectedValues the optionvalues selected
   */
  public function __construct($name = null, $opt = null, $selectedValues = null) {
    parent::__construct(self::TAG_NAME);
    if ($opt !== null) {
      $this->append($opt);
    }
    if (isset($name)) {
      $this->setName($name);
    }
    if ($selectedValues !== null) {
      $this->setSelectedValues($selectedValues);
    }
  }

  /**
   * Returns all {@link Option} components in the component
   * 
   * @return Container containing {@link Option} components
   */
  public function getOptions() {
    $isOption = function($component) {
      return $component instanceof Option;
    };
    return $this->getComponentsBy($isOption);
  }

  /**
   * Returns all the selected {@link Option} components in the component
   * 
   * @return Container containing selected {@link Option} components
   */
  public function getSelectedOptions() {
    $isSelected = function($component) {
      if ($component instanceof Option) {
        return $component->isSelected();
      } else {
        return false;
      }
    };
    return $this->getComponentsBy($isSelected);
  }

  /**
   * Sets the selected options of the menu object
   *
   * @param  scalar|scalar[] $selectedValues selected options of the menu object
   * @return self for PHP Method Chaining
   */
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

  /**
   * Returns the selected options of the menu object
   *
   * @return scalar[] selected options of the menu object
   */
  public function getSelectedValues() {
    $selected = [];
    foreach ($this->getSelectedOptions() as $option) {
      $selected[] = $option->getValue();
    }
    return array_unique($selected);
  }

  /**
   * Returns selected values of the component
   *
   * @return scalar[] selected values of menu
   */
  public function getValue() {
    return $this->getSelectedValues();
  }

  /**
   * Sets the selected {@link Option} values of the component
   *
   * @param  scalar|scalar[] $value new selected values of the menu
   * @return self for PHP Method Chaining
   */
  public function setValue($value) {
    return $this->setSelectedValues($value);
  }

  /**
   * Specifies that multiple options can or cannot be selected at once
   * 
   * @param  boolean $multiple true if multiple selections are allowed, 
   *         otherwise false
   * @return self for PHP Method Chaining
   */
  public function selectMultiple($multiple = true) {
    return $this->setAttr("multiple", $multiple);
  }

  /**
   * Sets the number of the visible {@link Option} components
   * 
   * **Note:** In Chrome and Safari, this attribute may not work as 
   *  expected for size="2" and size="3".
   * 
   * @param  int $size the number of the visible {@link Option} components
   * @return self for PHP Method Chaining
   */
  public function setSize($size) {
    return $this->setAttr("size", $size);
  }

}
