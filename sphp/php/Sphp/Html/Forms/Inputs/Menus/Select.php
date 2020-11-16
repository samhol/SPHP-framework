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

use Sphp\Html\Forms\Inputs\ValidableInput;
use IteratorAggregate;
use Sphp\Html\AbstractComponent;
use Traversable;
use Sphp\Html\ContentIterator;
use Sphp\Stdlib\Arrays;
use Countable;

/**
 * Implementation of an HTML select tag
 *
 * This element is used to create a drop-down list. Options and option groups 
 * define the available options in the list.
 *
 * **Notes:**
 *
 * * This component can be used in a form to collect user input.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_select.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Select extends AbstractComponent implements ValidableInput, IteratorAggregate, Countable {

  /**
   * @var MenuComponent[] 
   */
  private $options;

  /**
   * Constructor
   * 
   * @param string|null $name name attribute
   */
  public function __construct(string $name = null) {
    parent::__construct('select');
    if ($name !== null) {
      $this->setName($name);
    }
    $this->options = [];
  }

  public function __destruct() {
    unset($this->options);
    parent::__destruct();
  }

  public function __clone() {
    $this->options = Arrays::copy($this->options);
    parent::__clone();
  }

  /**
   * Prepends content to the component
   *
   * @param  MenuComponent $opt the content
   * @return $this for a fluent interface
   */
  public function prepend(MenuComponent $opt) {
    array_unshift($this->options, $opt);
    return $this;
  }

  /**
   * Appends a new option to the component
   * 
   * @param  string $value the value attribute of the option
   * @param  string $content the textual content of the option
   * @return Option appended instance
   * @link   http://www.w3schools.com/tags/att_option_value.asp value attribute
   */
  public function appendOption($value, string $content = null): Option {
    $option = new Option($value, $content);
    $this->append($option);
    return $option;
  }

  /**
   * Appends a new optgroup to the component
   *
   * **Recognized mixed $opt types:**
   * 
   * 1. a  {@link SelectContentInterface} $opt is stored as such
   * 2. a `scalar[]` $opt with $key => $val pairs corresponds to an array of new 
   *    {@link Option}($key, $val) objects
   * 3. nested arrays are converted to {@link Optgroup} objects having the root 
   *    key of the nested array as a label of the group
   * 
   * @param  string|null $label specifies a label for an option-group
   * @param  Option|(Option|scalar)[]|null $opt the content
   * @return Optgroup appended instance
   */
  public function appendOptgroup(string $label = null, $opt = null): Optgroup {
    $group = new Optgroup($label);
    if (is_array($opt)) {
      $group->appendArray($opt);
    } else if ($opt instanceof Option) {
      $group->append($opt);
    }
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
    $this->options[] = $opt;
    return $this;
  }

  public function appendArray(array $opts) {
    foreach ($opts as $index => $option) {
      if (is_array($option)) {
        $optGroup = new Optgroup((string) $index);
        $optGroup->appendArray($option);
        $this->append($optGroup);
      } else {
        $this->append(new Option($index, (string) $option));
      }
    }
    return $this;
  }

  /**
   * Counts the number of menu components
   * 
   * @return int the number of menu components
   */
  public function count(): int {
    return count($this->getOptions());
  }

  /**
   * Retrieves an external iterator
   * 
   * @return Traversable external iterator
   */
  public function getIterator(): Traversable {
    return new ContentIterator($this->options);
  }

  public function getOptions(): iterable {
    $opts = [];
    foreach ($this as $item) {
      if ($item instanceof Optgroup) {
        $opts = array_merge($opts, iterator_to_array($item));
      } else {
        $opts[] = $item;
      }
    }
    return $opts;
  }

  public function contentToString(): string {
    return implode('', $this->options);
  }

  public function getSubmitValue() {
    $selected = [];
    foreach ($this->getOptions() as $option) {
      if ($option->isSelected() && $option->isEnabled()) {
        $selected[] = $option->getValue();
      }
    }
    if (!$this->allowMultiple() && count($selected) > 1) {
      $selected = [array_pop($selected)];
    }
    return $selected;
  }

  /**
   * Sets the selected options of the menu object
   *
   * @param  scalar|scalar[] $value selected options of the menu object
   * @return $this for a fluent interface
   */
  public function setInitialValue($value) {
    if (!is_array($value)) {
      $value = array($value);
    }
    foreach ($this->getOptions() as $option) {
      if (in_array($option->getValue(), $value)) {
        $option->setSelected(true);
      } else if ($option->isSelected()) {
        $option->setSelected(false);
      }
    }
    return $this;
  }

  /**
   * Specifies that multiple options can or cannot be selected at once
   * 
   * @param  boolean $multiple true if multiple selections are allowed, 
   *         otherwise false
   * @return $this for a fluent interface
   */
  public function selectMultiple(bool $multiple = true) {
    $this->attributes()->setAttribute('multiple', $multiple);
    return $this;
  }

  public function allowMultiple(): bool {
    return $this->attributeExists('multiple');
  }

  /**
   * Sets the number of the visible &lt;option&gt; components
   * 
   * **Note:** In Chrome and Safari, this attribute may not work as 
   *  expected for size="2" and size="3".
   * 
   * @param  int $size optional number of visible &lt;option&gt; components
   * @return $this for a fluent interface
   */
  public function setSize(int $size = null) {
    $this->attributes()->setAttribute('size', $size);
    return $this;
  }

  public function setRequired(bool $required = true) {
    $this->attributes()->setAttribute('required', $required);
    return $this;
  }

  public function isRequired(): bool {
    return $this->attributeExists('required');
  }

  public function getName(): ?string {
    return $this->attributes()->getValue('name');
  }

  public function setName(string $name = null) {
    $this->attributes()->setAttribute('name', $name);
    return $this;
  }

  public function isNamed(): bool {
    return $this->attributes()->isVisible('name');
  }

  public function disable(bool $disabled = true) {
    $this->attributes()->setAttribute('disabled', $disabled);
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->isVisible('disabled');
  }

  public function toArray(): array {
    return $this->options;
  }

  public static function from(string $name = null, array $opts = []): Select {
    $select = new Select($name);
    if (count($opts) > 0) {
      $select->appendArray($opts);
    }
    return $select;
  }

}
