<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
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

  /**
   * @var array
   */
  private $query;

  /**
   * Constructor
   *
   * @param string|array|Traversable|null $query the URL string
   */
  public function __construct($query = null) {
    if (is_string($query)) {
      parse_str($query, $this->query);
    } else if (is_array($query)) {
      $this->query = $query;
    } else if ($query instanceof Traversable) {
      $this->query = iterator_to_array($query, true);
    } else {
      $this->query = [];
    }
  }

  /**
   * Checks whether the query is empty
   * 
   * @return boolean true if the query is empty and false otherwise
   */
  public function isEmpty(): bool {
    return empty($this->query);
  }

  /**
   * Checks whether a parameter exists in the query
   * 
   * @param  mixed $name the name of the parameter
   * @return boolean true if the parameter exists and false otherwise
   */
  public function contains($name): bool {
    return array_key_exists($name, $this->query);
  }

  /**
   * Return the value of the parameter
   *
   * @param  mixed $name the name of the parameter
   * @return mixed|null the value of the parameter or null if the parameter does not exist
   */
  public function get($name) {
    return $this->offsetGet($name);
  }

  /**
   * Sets or replaces a parameter in the query
   *
   * @param  mixed $name the name of the parameter
   * @param  mixed $value the value of the parameter
   * @return $this for a fluent interface
   */
  public function set($name, $value) {
    $this->offsetSet($name, $value);
    return $this;
  }

  /**
   * Sets or replaces parameters in the query
   *
   * @param  array|string|QueryString $params parameter name => value pairs or a query string
   * @return $this for a fluent interface
   */
  public function merge($params) {
    if (!$params instanceof QueryString) {
      $params = new static($params);
    }
    $this->query = array_replace_recursive($this->query, $params->toArray());
    return $this;
  }

  /**
   * Removes a parameter from the query
   *
   * @param  mixed $name the name of the parameter to remove
   * @return $this for a fluent interface
   */
  public function delete($name) {
    $this->offsetUnset($name);
    return $this;
  }

  /**
   * Checks whether a parameter exists in the query
   * 
   * @param  mixed $name the name of the parameter
   * @return boolean true if the parameter exists and false otherwise
   */
  public function offsetExists($name): bool {
    return array_key_exists($name, $this->query);
  }

  /**
   * Return the value of the parameter
   *
   * @param  mixed $name the name of the parameter
   * @return mixed|null the value of the parameter or null if the parameter does not exist
   */
  public function offsetGet($name) {
    $val = null;
    if ($this->offsetExists($name)) {
      $val = $this->query[$name];
    }
    return $val;
  }

  /**
   * Sets or replaces a parameter in the query
   *
   * @param  mixed $name the name of the parameter
   * @param  mixed $value the value of the parameter
   * @return $this for a fluent interface
   */
  public function offsetSet($name, $value) {
    $this->query[$name] = $value;
    return $this;
  }

  /**
   * Removes a parameter from the query
   *
   * @param  mixed $name the name of the parameter to remove
   * @return $this for a fluent interface
   */
  public function offsetUnset($name) {
    if (array_key_exists($name, $this->query)) {
      unset($this->query[$name]);
    }
    return $this;
  }

  /**
   * Determines whether the specified object is equal to the current object
   *
   * @param  string|QueryString $url the URL to compare with the current URL
   * @return boolean true if the specified URL is equal to the current URL, otherwise false
   */
  public function equals($url): bool {
    if (!($url instanceof QueryString)) {
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
    return $this->getHtml();
  }

  /**
   * Returns the query string part of the URL
   * 
   * The query string contains data to be passed to software running on the 
   * server. It may contain name/value pairs separated by ampersands.
   * 
   * @param  string $separator
   * @param  int $encode
   * @return string the query string of the URL
   */
  public function build(string $separator = '&amp;', int $encode = \PHP_QUERY_RFC1738): string {
    $val = '';
    if (!$this->isEmpty()) {
      $val = http_build_query($this->query, '', $separator, $encode);
    }
    return trim($val, '=');
  }

  /**
   * Returns the object as a HTML5 encoded string
   *
   * @return string representation of the object
   */
  public function getHtml(): string {
    return $this->build('&amp;', \PHP_QUERY_RFC3986);
  }

  /**
   * Returns the object as a raw unencoded string
   *
   * @return string representation of the object
   */
  public function getRaw(): string {
    return $this->build('&', \PHP_QUERY_RFC3986);
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
  public function current() {
    return current($this->query);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->query);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->query);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->query);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
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
  public static function getCurrent(int $filter = \FILTER_SANITIZE_STRING): QueryString {
    $query = filter_input(\INPUT_SERVER, 'QUERY_STRING', $filter);
    return new static($query);
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
   * @codeCoverageIgnore
   */
  public static function fromURL(string $url): QueryString {
    return new static(parse_url($url, \PHP_URL_QUERY));
  }

}
