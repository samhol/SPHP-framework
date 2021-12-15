<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Html\AbstractComponent;
use IteratorAggregate;
use Traversable;
use Sphp\Html\ContentIterator;
use Sphp\Stdlib\Arrays;

/**
 * Class AbstractOptionContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractOptions extends AbstractComponent implements OptionsMenu, IteratorAggregate {

  /**
   * @var Option[] 
   */
  private array $options;

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
   * Appends a new option to the component
   * 
   * @param  scalar|null $value the value attribute of the option
   * @param  string $content the textual content of the option
   * @return Option appended instance
   * @link   https://www.w3schools.com/tags/att_option_value.asp value attribute
   */
  public function appendOption($value, string $content = null): Option {
    $option = new Option($value, $content);
    $this->append($option);
    return $option;
  }

  /**
   * Appends content to the component
   *
   * @param  Option $opt the content
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
   * @return Traversable<int, Option> external iterator
   */
  public function getIterator(): Traversable {
    return new ContentIterator($this->options);
  }

  /**
   * @inheritDoc
   * 
   * @return array<int, Option>
   */
  public function toArray(): array {
    return $this->options;
  }

  public function contentToString(): string {
    return implode('', $this->options);
  }

}
