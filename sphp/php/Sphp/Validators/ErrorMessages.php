<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Iterator;
use ArrayAccess;
use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\Exceptions\InvalidArgumentException;
use Traversable;
use Sphp\Stdlib\Arrays;

/**
 * Description of ErrorMessages
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ErrorMessages implements Iterator, ArrayAccess, Countable, Arrayable {

  /**
   * stores error messages if not valid
   *
   * @var string[]
   */
  private $errors;

  /**
   * @var string[] 
   */
  private $templates = [];

  /**
   * Constructor
   */
  public function __construct() {
    $this->templates = [];
    $this->errors = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->templates, $this->errors);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->errors = Arrays::copy($this->errors);
    $this->templates = Arrays::copy($this->templates);
  }

  /**
   * Returns the template pointed by the given id
   * 
   * @param  string $id the id pointing to the template
   * @return string the template text
   * @throws InvalidArgumentException if the template does not exist
   */
  public function getTemplate(string $id): string {
    if (!$this->containsTemplate($id)) {
      throw new InvalidArgumentException("Template with id: '$id' does not exist");
    }
    return $this->templates[$id];
  }

  /**
   * Sets an id template pair
   * 
   * @param  string $id the id pointing to the template
   * @param  string $template the template text
   * @return $this for a fluent interface
   */
  public function setTemplate(string $id, string $template) {
    $this->templates[$id] = $template;
    return $this;
  }

  /**
   * Checks whether a template is set or not
   * 
   * @param  string $id the id pointing to the template
   * @return bool true if template exists, otherwise false
   */
  public function containsTemplate(string $id): bool {
    return array_key_exists($id, $this->templates);
  }

  /**
   * Sets the error message 
   * 
   * @param  string $id the id pointing to the template
   * @param  array $params optional message parameters
   * @return $this for a fluent interface
   */
  public function appendErrorFromTemplate(string $id, array $params = []) {
    $this->errors[] = vsprintf($this->getTemplate($id), $params);
    return $this;
  }

  /**
   * Appends an error message
   * 
   * @param  string|array|ErrorMessages $content the content to append
   * @return $this for a fluent interface
   */
  public function append($content) {
    $this[] = $content;
    return $this;
  }

  /**
   * Merges a collection of error messages 
   * 
   * @param  array|Traversable $errors collection to merge
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the merging fails
   */
  public function mergeCollection($errors) {
    if (!is_array($errors) && !$errors instanceof \Traversable) {
      throw new InvalidArgumentException('Cannot merge ' . gettype($errors) . ' type');
    }
    foreach ($errors as $error) {
      $this[] = $error;
    }
    return $this;
  }

  /**
   * Empties the collection
   *
   * @return $this for a fluent interface
   */
  public function setEmpty() {
    $this->errors = [];
    return $this;
  }

  public function toArray(): array {
    $arr = [];
    foreach ($this as $key => $value) {
      if ($value instanceof ErrorMessages) {
        $arr[$key] = $value->toArray();
      } else {
        $arr[$key] = $value;
      }
    }
    return $arr;
  }

  public function count(): int {
    return count($this->errors);
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->errors);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->errors);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->errors);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->errors);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current if iterator position is valid
   */
  public function valid(): bool {
    return null !== key($this->errors);
  }

  public function offsetExists($offset): bool {
    return array_key_exists($offset, $this->errors);
  }

  public function offsetGet($offset) {
    if ($this->offsetExists($offset)) {
      return $this->errors[$offset];
    }
    return null;
  }

  public function offsetSet($offset, $value) {
    if (is_array($value)) {
      $value = static::fromTraversable($value);
    }
    if (!$value instanceof ErrorMessages && !is_string($value)) {
      throw new InvalidArgumentException('Tried to set content of type: ' . gettype($value));
    }
    if ($offset === null) {
      $this->errors[] = $value;
    } else {
      $this->errors[$offset] = $value;
    }
  }

  public function offsetUnset($offset) {
    if ($this->offsetExists($offset)) {
      unset($this->errors[$offset]);
    }
  }

  public static function fromTraversable($data): ErrorMessages {
    if ($data instanceof Traversable) {
      $data = iterator_to_array($data, true);
    }
    $obj = new static();
    foreach ($data as $key => $value) {
      $obj[$key] = $value;
    }
    return $obj;
  }

}
