<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network;

use Sphp\Stdlib\Datastructures\Arrayable;
use Iterator;
use Traversable;
use JsonSerializable;
use ArrayAccess;

/**
 * Implements a query part of an URL
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class QueryString implements Arrayable, Iterator, JsonSerializable, ArrayAccess {

  private array $query = [];
  private string $separator;

  /**
   * Constructor
   *
   * @param string|iterable|null $query the URL string
   */
  /**
   * 
   * @param Traversable $query query data
   * @param string|null $separator
   */
  public function __construct($query = null, ?string $separator = null) {
    if (is_string($query)) {
      parse_str($query, $this->query);
    } else if (is_array($query)) {
      $this->query = $query;
    } else if ($query instanceof Traversable) {
      $this->query = iterator_to_array($query, true);
    } else if (is_object($query)) {
      $this->query = (array) $query;
    } else {
      $this->query = [];
    }
    $this->setSeparator($separator);
  }

  /**
   * Checks whether the query is empty
   * 
   * @return bool true if the query is empty and false otherwise
   */
  public function isEmpty(): bool {
    return empty($this->query);
  }

  /**
   * 
   * @return string
   */
  public function getSeparator(): string {
    return $this->separator;
  }

  /**
   * 
   * @param  string|null $separator
   * @return $this for a fluent interface
   */
  public function setSeparator(?string $separator) {
    if ($separator === null) {
      $separator = ini_get('arg_separator.input');
    }
    $this->separator = $separator;
    return $this;
  }

  /**
   * Checks whether a parameter exists in the query
   * 
   * @param  string $name the name of the parameter
   * @return bool true if the parameter exists and false otherwise
   */
  public function hasParameter(string $name): bool {
    return array_key_exists($name, $this->query);
  }

  /**
   * Return the value of the parameter
   *
   * @param  string $name the name of the parameter
   * @return mixed the value of the parameter or null if the parameter does not exist
   */
  public function getParameter(string $name): mixed {
    $val = null;
    if ($this->hasParameter($name)) {
      $val = $this->query[$name];
    }
    return $val;
  }

  /**
   * Sets or replaces a parameter in the query
   *
   * @param  string $name the name of the parameter
   * @param  mixed $value the value of the parameter
   * @return $this for a fluent interface
   */
  public function setParameter(string $name, $value) {
    $this->query[$name] = $value;
    return $this;
  }

  /**
   * Removes a parameter from the query
   *
   * @param  string $name the name of the parameter to remove
   * @return $this for a fluent interface
   */
  public function removeParameter(string $name) {
    if ($this->hasParameter($name)) {
      unset($this->query[$name]);
    }
    return $this;
  }

  /**
   * Sets or replaces parameters in the query
   *
   * @param  array|string|QueryString $params parameter name => value pairs or a query string
   * @return $this for a fluent interface
   */
  public function merge(mixed $params) {
    if (!$params instanceof QueryString) {
      $params = new static($params);
    }
    $this->query = array_replace_recursive($this->query, $params->toArray());
    return $this;
  }

  /**
   * Checks whether a parameter exists in the query
   * 
   * @param  mixed $name the name of the parameter
   * @return bool true if the parameter exists and false otherwise
   */
  public function offsetExists(mixed $name): bool {
    return $this->hasParameter((string) $name, $this->query);
  }

  /**
   * Return the value of the parameter
   *
   * @param  mixed $name the name of the parameter
   * @return mixed|null the value of the parameter or null if the parameter does not exist
   */
  public function offsetGet(mixed $name): mixed {
    return $this->getParameter((string) $name);
  }

  /**
   * Sets or replaces a parameter in the query
   *
   * @param  mixed $name the name of the parameter
   * @param  mixed $value the value of the parameter
   * @return void
   */
  public function offsetSet(mixed $name, mixed $value): void {
    $this->setParameter((string) $name, $value);
  }

  /**
   * Removes a parameter from the query
   *
   * @param  mixed $name the name of the parameter to remove
   * @return void
   */
  public function offsetUnset(mixed $name):void {
    $this->removeParameter((string) $name); 
  }

  /**
   * Determines whether the specified object is equal to the current object
   *
   * @param  string|QueryString $url the URL to compare with the current URL
   * @return bool true if the specified URL is equal to the current URL, otherwise false
   */
  public function equals($url): bool {
    if (!$url instanceof QueryString) {
      $url = new QueryString($url);
    }
    return $this->toArray() == $url->toArray();
  }

  /**
   * Returns the object as a HTML5 encoded string
   *
   * @return string representation of the object
   */
  public function __toString(): string {
    return $this->toRFC1738();
  }

  /**
   * Returns the query string part of the URL
   * 
   * The query string contains data to be passed to software running on the 
   * server. It may contain name/value pairs separated by ampersands.
   * 
   * @param  int $encode
   * @return string the query string of the URL
   */
  public function build(?int $encode = \PHP_QUERY_RFC1738): string {
    $val = '';
    if (!$this->isEmpty() && $encode !== null) {
      $val = http_build_query($this->query, '', $this->getSeparator(), $encode);
    } else {
      
    }
    return trim($val, '=');
  }

  public function toRFC1738(): string {
    return $this->build(\PHP_QUERY_RFC1738);
  }

  public function toRFC3986(): string {
    return $this->build(\PHP_QUERY_RFC3986);
  }

  public function jsonSerialize(): array {
    return $this->toArray();
  }

  public function toArray(): array {
    return $this->query;
  }

  public function toJson(): string {
    return json_encode($this->toArray());
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current(): mixed {
    return current($this->query);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next(): void {
    next($this->query);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key(): mixed {
    return key($this->query);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind(): void {
    reset($this->query);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return bool current iterator position is valid
   */
  public function valid(): bool {
    return null !== key($this->query);
  }

  /**
   * Returns the current query string object
   * 
   * @param  int $filter
   * @return QueryString new instance
   * @codeCoverageIgnore
   */
  public static function fromGET(int $filter = \FILTER_SANITIZE_STRING): QueryString {
    return new static(filter_input_array(\INPUT_GET, $filter));
  }

  /**
   * Parses and returns the query object from given url
   * 
   * @param  string $url the URL 
   * @return QueryString new instance
   */
  public static function fromURL(string $url): QueryString {
    return new static(parse_url($url, \PHP_URL_QUERY));
  }

}
