<?php

/**
 * OptionHandlingTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Core\Types\Strings;

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
   * 2. a string $opt corresponds to a new {@link Option}($opt, $opt) object
   * 3. a string[] $opt with $key => $val pairs corresponds to an array of new 
   *    {@link Option}($key, $val) objects
   * 4. all other types of $opt are converted to strings and and stored as in 
   *    section 2.
   * 
   * @param string $label specifies a label for an option-group
   * @param mixed|mixed[] $opt the content 
   * @param boolean $disabled whether the Optgroup is enabled or not
   */
  public function appendOptgroup($label, $opt = null, $disabled = false) {
    $this->append(new Optgroup($label, $opt, $disabled));
    return $this;
  }

  /**
   * Returns the input as an array of {@link SelectMenuContentInterface} components
   *
   * <var>$opt</var> parameter:
   * 
   * 1. a {@link SelectMenuContentInterface} is stored as such
   * 2. a single dimensional array with $key => $val pairs corresponds to an 
   *    array of new {@link Option}($key, $val) objects
   * 3. a multidimensional array corresponds to a multidimensional menu structure with 
   *    {@link Optgroup} components containing new {@link Option}($key, $val) objects
   * 4. all other types are converted to strings and and stored as new 
   *    {@link Option}($opt, $opt) object
   *
   * @param  mixed $opt the content
   * @return SelectMenuContentInterface[] menu components
   */
  protected function toMenuContent($opt) {
    $newOpts = [];
    if (is_scalar($opt)) {
      $newOpts[] = new Option($opt, $opt);
    } else if ($opt instanceof SelectMenuContentInterface) {
      $newOpts[] = $opt;
    } else if (is_array($opt)) {
      foreach ($opt as $index => $option) {
        if ($option instanceof SelectMenuContentInterface) {
          $newOpts[] = $option;
        } else if (is_array($option)) {
          $newOpts[] = new Optgroup($index, $option);
        } else {
          $newOpts[] = new Option($index, $option);
        }
      }
    }
    //echo "<pre style='font-size:8px;'>";
    //print_r($newOpts);
    return $newOpts;
  }

  protected function toOption($opt) {
    if (is_scalar($opt)) {
      return new Option($opt, $opt);
    } else if ($opt instanceof SelectMenuContentInterface) {
      return $opt;
    } else if (is_array($opt)) {
      return new Option(key($opt), current($opt));
    } else {
      $val = Strings::toString($opt);
      return new Option($val, $val);
    }
  }

  /**
   * Appends {@link SelectContentInterface} objects to the component
   * 
   * <var>$opt</var> parameter:
   * 
   * 1. a {@link SelectMenuContentInterface} is stored as such
   * 2. a single dimensional array with $key => $val pairs corresponds to an 
   *    array of new {@link Option}($key, $val) objects
   * 3. a multidimensional array corresponds to a multidimensional menu structure with 
   *    {@link Optgroup} components containing new {@link Option}($key, $val) objects
   * 4. all other types are converted to strings and and stored as new 
   *    {@link Option}($opt, $opt) object
   *
   * @param  mixed|mixed[] $opt the content
   * @return self for PHP Method Chaining
   */
  public function append($opt) {
    $this->content()->append($this->toMenuContent($opt));
    return $this;
  }

  /**
   * Prepends {@link SelectContentInterface} objects to the component
   *
   * **Notes:**
   *
   *  **All numerical keys pointing to content will be modified to start 
   * counting from zero while literal keys won't be touched.**
   *
   * 
   * <var>$opt</var> parameter:
   * 
   * 1. a {@link SelectMenuContentInterface} is stored as such
   * 2. a single dimensional array with $key => $val pairs corresponds to an 
   *    array of new {@link Option}($key, $val) objects
   * 3. a multidimensional array corresponds to a multidimensional menu structure with 
   *    {@link Optgroup} components containing new {@link Option}($key, $val) objects
   * 4. all other types are converted to strings and and stored as new 
   *    {@link Option}($opt, $opt) object
   *
   * @param  mixed|mixed[] $opt the content
   * @return self for PHP Method Chaining
   */
  public function prepend($opt) {

    $this->content()->prepend($this->toMenuContent($opt));
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function count() {
    return $this->content()->count();
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return $this->content()->getIterator();
  }

}
