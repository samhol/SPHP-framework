<?php

/**
 * OptionHandlingTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs\Menus;

/**
 * A trait for handling the {@link Option} objects inside the {@link Optgroup} and {@link Select} containers

 * **Notes:**
 *
 * **Nesting {@link Optgroup} in a {@link Select} menu:** The HTML spec
 * here is broken. It should allow nested optgroups and recommend user agents 
 * render them as nested menus. Instead, only one optgroup level is allowed. 
 * However Implementors are advised that future versions of HTML may extend the 
 * grouping mechanism to allow for nested groups (i.e., OPTGROUP elements may 
 * nest). This will allow authors to represent a richer hierarchy of choices.
 *
 * Because of the above nesting of {@link Optgroup} objects is supported but 
 * not recomended.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-06-10
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait OptionHandlingTrait {

  /**
   * 1. a  {@link SelectContentInterface} $options is stored as such
   * 2. a `scalar[]` $options with $key => $val pairs corresponds to an array of new 
   *    {@link Option}($key, $val) objects
   * 3. nested arrays are converted to {@link Optgroup} objects having the root 
   *    key of the nested array as a label of the group
   * 
   * @param array $options
   * @return self for PHP Method Chaining
   */
  public function appendArray(array $options) {
    foreach ($options as $index => $option) {
      if ($option instanceof SelectMenuContentInterface) {
        $this->append($option);
      } else if (is_array($option)) {
        $this->appendOptgroup($index, $option);
      } else {
        $this->append(new Option($index, $option));
      }
    }
    return $this;
  }

  /**
   * Appends a new {@link Option} object to the component
   * 
   * @param  string $value the value attribute of the option
   * @param  string $content the textual content of the option
   * @param  boolean $selected whether the option is selected or not
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_option_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_option_selected.asp selected attribute
   */
  public function appendOption($value, $content = null, $selected = false) {
    $this->append(new Option($value, $content, $selected));
    return $this;
  }

  /**
   * Appends a new {@link Optgroup} object to the component
   *
   * **Recognized mixed $opt types:**
   * 
   * 1. a  {@link SelectContentInterface} $opt is stored as such
   * 2. a `scalar[]` $opt with $key => $val pairs corresponds to an array of new 
   *    {@link Option}($key, $val) objects
   * 3. nested arrays are converted to {@link Optgroup} objects having the root 
   *    key of the nested array as a label of the group
   * 
   * @param string $label specifies a label for an option-group
   * @param SelectMenuContentInterface|mixed[] $opt the content 
   * @param boolean $disabled whether the Optgroup is enabled or not
   * @return self for PHP Method Chaining
   */
  public function appendOptgroup($label, $opt = null, $disabled = false) {
    $this->append(new Optgroup($label, $opt, $disabled));
    return $this;
  }

  /**
   * Appends content to the menu
   *
   * @param  SelectMenuContentInterface $opt the content
   * @return self for PHP Method Chaining
   */
  public function append(SelectMenuContentInterface $opt) {
    $this->getInnerContainer()->append($opt);
    return $this;
  }

  public function count() {
    return $this->getInnerContainer()->count();
  }

  public function getIterator() {
    return $this->getInnerContainer()->getIterator();
  }

}
