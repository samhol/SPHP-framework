<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use IteratorAggregate;
use Sphp\Html\AbstractComponent;
use Traversable;
use Sphp\Html\ContentIterator;
use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Datastructures\Arrayable;
use Countable;

/**
 * Class AbstractOptionContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractOptionContainer extends AbstractComponent implements IteratorAggregate, Arrayable, Countable {

  /**
   * @var Option[] 
   */
  private $options;

  /**
   * Constructor
   *
   * @param string $tagname the name of the tag
   */
  public function __construct(string $tagname) {
    parent::__construct($tagname);
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
   * @param  Option $opt the content
   * @return $this for a fluent interface
   */
  public function prepend(Option $opt) {
    array_unshift($this->options, $opt);
    return $this;
  }

  /**
   * Appends an array of content to the component
   * 
   * 1. a  {@link SelectContentInterface} $options is stored as such
   * 2. a `scalar[]` $options with $key => $val pairs corresponds to an array of new 
   *    {@link \Sphp\Html\Forms\Inputs\Menus\Option}($key, $val) objects
   * 3. nested arrays are converted to {@link Optgroup} objects having the root 
   *    key of the nested array as a label of the group
   * 
   * @param  array $options
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function appendArray(array $options) {
    foreach ($options as $index => $option) {
      if ($option instanceof Option) {
        $this->append($option);
      } else if (is_scalar($option) || is_null($option)) {
        $this->appendOption($index, (string) $option);
      } else {
        throw new InvalidArgumentException('Invalid option data at ' . $index);
      }
    }
    return $this;
  }

  /**
   * Appends a new option to the component
   * 
   * @param  scalar|null $value the value attribute of the option
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
   * Appends content to the component
   *
   * @param  MenuComponent $opt the content
   * @return $this for a fluent interface
   */
  public function append(Option $opt) {
    $this->options[] = $opt;
    return $this;
  }

  /**
   * Counts the number of Options
   * 
   * @return int the number of Options
   */
  public function count(): int {
    return count($this->options);
  }

  /**
   * Retrieves an external iterator
   * 
   * @return Traversable external iterator
   */
  public function getIterator(): Traversable {
    return new ContentIterator($this->options);
  }

  public function toArray(): array {
    return $this->options;
  }

  public function contentToString(): string {
    return implode('', $this->options);
  }

}
