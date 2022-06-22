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
 * @link    https://www.w3schools.com/tags/tag_select.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Select extends AbstractComponent implements ValidableInput, IteratorAggregate, OptionsMenu {

  /**
   * @var MenuComponent[] 
   */
  private array $options;

  /**
   * Constructor
   * 
   * @param string|null $name the name attribute of the input
   * @param iterable<MenuComponent>|null $options
   */
  public function __construct(?string $name = null, ?iterable $options = null) {
    parent::__construct('select');
    $this->options = [];
    if ($name !== null) {
      $this->setName($name);
    }
    if ($options !== null) {
      $this->appendOptions($options);
    }
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
   * @link   https://www.w3schools.com/tags/att_option_value.asp value attribute
   */
  public function appendOption(string|int|float|null $value, string|int|float|null $content): Option {
    $option = new Option($value, $content);
    $this->append($option);
    return $option;
  }

  /**
   * Appends an array of content to the component
   * 
   * <code>$options</code> with <code>$key => $val</code> pairs:
   * 
   * 1. an {@see Option} <code>$val</code> is stored as such
   * 2. a scalar <code>$val</code> is stored as an {@see Option}($key, $val)
   * 3. nested iterables are converted to {@see Optgroup} objects having the root 
   *    key of the nested array as a label of the group
   * 
   * @param  string|null $label the label for the optgroup
   * @param  iterable<string|int, scalar|MenuComponent> $options
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   * @see    Option
   */
  public function appendOptgroup(?string $label = null, ?iterable $opt = null): Optgroup {
    $group = new Optgroup($label, $opt);
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

  /**
   * Appends an array of content to the component
   * 
   * <code>$options</code> with <code>$key => $val</code> pairs:
   * 
   * 1. an {@see Option} <code>$val</code> is stored as such
   * 2. a scalar <code>$val</code> is stored as an {@see Option}($key, $val)
   * 3. nested arrays are converted to {@see Optgroup} objects having the root 
   *    key of the nested array as a label of the group
   * 3. all other data results to an exception thrown
   * 
   * @param  iterable<string|int, scalar|MenuComponent> $options
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   * @see    MenuComponent
   * @see    Option
   * @see    Optgroup
   */
  public function appendOptions(iterable $opts) {
    foreach ($opts as $index => $option) {
      if (is_iterable($option)) {
        $optGroup = new Optgroup((string) $index);
        $optGroup->appendOptions($option);
        $this->append($optGroup);
      } else {
        $this->append(new Option($index, (string) $option));
      }
    }
    return $this;
  }

  /**
   * Counts the number of options
   * 
   * @return int the number of options
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

  /**
   * Returns all the Option components
   * 
   * @return iterable<int, Option> all the Option components
   */
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
    if (!$this->attributeExists('multiple') && count($selected) > 1) {
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
   * @param  bool $multiple true if multiple selections are allowed, 
   *         otherwise false
   * @return $this for a fluent interface
   */
  public function selectMultiple(bool $multiple = true) {
    $this->attributes()->setAttribute('multiple', $multiple);
    return $this;
  }

  /**
   * Sets the number of the visible &lt;option&gt; components
   * 
   * **Note:** In Chrome and Safari, this attribute may not work as 
   *  expected for size="2" and size="3".
   * 
   * @param  int|null $size optional number of visible &lt;option&gt; components
   * @return $this for a fluent interface
   */
  public function setSize(?int $size) {
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

  public function setName(?string $name) {
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

}
