<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use IteratorAggregate;
use Sphp\Html\AbstractComponent;
use Sphp\Html\TraversableContent;
use Traversable;
use Sphp\Html\PlainContainer;

/**
 * Abstract implementation of ann HTML &lt;option&gt; component container

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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AbstractOptionsContainer extends AbstractComponent implements IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var PlainContainer 
   */
  private $options;

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
   * @param string $tagname the name of the tag
   * @param MenuComponent|mixed[] $opt the content
   */
  public function __construct(string $tagname, $opt = null) {
    parent::__construct($tagname);
    $this->options = new PlainContainer();
    if (is_array($opt)) {
      $this->appendArray($opt);
    } else if ($opt instanceof SelectMenuContentInterface) {
      $this->append($opt);
    }
  }

  /**
   * Prepends content to the component
   *
   * @param  MenuComponent $opt the content
   * @return $this for a fluent interface
   */
  public function prepend(MenuComponent $opt) {
    $this->options->prepend($opt);
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
   * @return $this for a fluent interface
   */
  public function appendArray(array $options) {
    foreach ($options as $index => $option) {
      if ($option instanceof MenuComponent) {
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
   * @return Option appended instance
   * @link   http://www.w3schools.com/tags/att_option_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_option_selected.asp selected attribute
   */
  public function appendOption($value, string $content = null, bool $selected = false): Option {
    $option = new Option($value, $content, $selected);
    $this->append($option);
    return $option;
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
   * @param  string $label specifies a label for an option-group
   * @param  MenuComponent|mixed[] $opt the content 
   * @param  boolean $disabled whether the Optgroup is enabled or not
   * @return Optgroup appended instance
   */
  public function appendOptgroup(string $label, $opt = null, bool $disabled = false): Optgroup {
    $group = new Optgroup($label, $opt, $disabled);
    $this->append($group);
    return $group;
  }

  /**
   * Appends content to the component
   *
   * @param  MenuComponent $opt the content
   * @return $this for a fluent interface
   */
  public function append(MenuComponent $opt) {
    $this->options->append($opt);
    return $this;
  }

  /**
   * Counts the number of menu components
   * 
   * @return int the number of menu components
   */
  public function count(): int {
    return $this->options->count();
  }

  /**
   * Retrieves an external iterator
   * 
   * @return Traversable external iterator
   */
  public function getIterator(): Traversable {
    return $this->options->getIterator();
  }

  public function contentToString(): string {
    return $this->options->getHtml();
  }

}
