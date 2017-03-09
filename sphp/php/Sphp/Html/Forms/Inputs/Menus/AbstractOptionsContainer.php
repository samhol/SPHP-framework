<?php

/**
 * AbstractOptionContainer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use IteratorAggregate;
use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\TraversableInterface;
use Traversable;

/**
 * Abstract implementation of a select menu content container

 * **Notes:**
 *
 * **Nesting {@link Optgroup} in menus:** The HTML spec
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
abstract class AbstractOptionsContainer extends AbstractContainerComponent implements IteratorAggregate, TraversableInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   * Constructs a new instance
   *
   * **`$opt` types:**
   * 
   * 1. a {@link SelectContentInterface} is stored as such
   * 2. a single dimensional array with $key => $val pairs corresponds to an 
   *    array of new {@link Option}($key, $val) objects
   * 3. a multidimensional array corresponds to a multidimensional menu structure with 
   *    {@link Optgroup} components containing new {@link Option}($key, $val) objects
   * 
   * @param  string $tagname the name of the tag
   * @param SelectMenuContentInterface|mixed[] $opt the content
   */
  public function __construct($tagname, $opt = null) {
    parent::__construct($tagname);
    if (is_array($opt)) {
      $this->appendArray($opt);
    } else if ($opt instanceof SelectMenuContentInterface) {
      $this->append($opt);
    }
  }
  /**
   * Prepends content to the component
   *
   * @param  SelectMenuContentInterface $opt the content
   * @return self for a fluent interface
   */
  public function prepend(SelectMenuContentInterface $opt) {
    $this->getInnerContainer()->prepend($opt);
    return $this;
  }

  /**
   * Appends an array of content to the component
   * 
   * 1. a  {@link SelectContentInterface} $options is stored as such
   * 2. a `scalar[]` $options with $key => $val pairs corresponds to an array of new 
   *    {@link Option}($key, $val) objects
   * 3. nested arrays are converted to {@link Optgroup} objects having the root 
   *    key of the nested array as a label of the group
   * 
   * @param array $options
   * @return self for a fluent interface
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
   * @return self for a fluent interface
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
   * @return self for a fluent interface
   */
  public function appendOptgroup($label, $opt = null, $disabled = false) {
    $this->append(new Optgroup($label, $opt, $disabled));
    return $this;
  }

  /**
   * Appends content to the component
   *
   * @param  SelectMenuContentInterface $opt the content
   * @return self for a fluent interface
   */
  public function append(SelectMenuContentInterface $opt) {
    $this->getInnerContainer()->append($opt);
    return $this;
  }

  /**
   * Counts the number of {@link SelectMenuContentInterface} 
   * 
   * @return int the number of {@link SelectMenuContentInterface} 
   */
  public function count() {
    return $this->getInnerContainer()->count();
  }

  /**
   * Retrieves an external iterator
   * 
   * @return Traversable external iterator
   */
  public function getIterator() {
    return $this->getInnerContainer();
  }

}
