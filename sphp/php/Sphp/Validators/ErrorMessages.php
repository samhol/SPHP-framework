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

/**
 * Description of ErrorMessages
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
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
   * 
   * @param  string $id
   * @param  string $template
   * @return $this for a fluent interface
   */
  public function setTemplate(string $id, string $template) {
    $this->templates[$id] = $template;
    return $this;
  }

  /**
   * Checks whether a template is set or not
   * 
   * @param  string $id
   * @return bool
   */
  public function containsTemplate(string $id): bool {
    return array_key_exists($id, $this->templates);
  }

  /**
   * Sets the error message 
   * 
   * @param  string $id the id of the message
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
    if (is_array($content)) {
      $this->appendArray($content);
    } else if ($content instanceof ErrorMessages) {
      $this->appendCollection($content);
    } else if (is_string($content)) {
      $this->errors[] = $content;
    } else {
      throw new InvalidArgumentException('Tried to append content of type: ' . gettype($content));
    }
    return $this;
  }

  /**
   * Appends an error message
   * 
   * @param  string $message the message to append
   * @return $this for a fluent interface
   */
  public function appendError(string $message) {
    $this->errors[] = $message;
    return $this;
  }

  /**
   * Appends a collection of error messages 
   * 
   * @param  ErrorMessages $errors collection to append
   * @return $this for a fluent interface
   */
  public function appendCollection(ErrorMessages $errors) {
    $this->errors[] = $errors;
    return $this;
  }

  /**
   * Appends an array of error messages 
   * 
   * @param  array $errors array to append
   * @return ErrorMessages appended object
   */
  public function appendArray(array $errors): ErrorMessages {
    $obj = new ErrorMessages();
    $obj->mergeArray($errors);
    $this->errors[] = $obj;
    return $obj;
  }

  /**
   * Appends a collection of error messages 
   * 
   * @param  ErrorMessages $errors collection to append
   * @return $this for a fluent interface
   */
  public function mergeCollection(ErrorMessages $errors) {
    foreach ($errors as $error) {
      $this->errors[] = $error;
    }
    return $this;
  }

  /**
   * Appends an array of error messages 
   * 
   * @param  array $errors array to append
   * @return $this for a fluent interface
   */
  public function mergeArray(array $errors) {
    foreach ($errors as $error) {
      if (!is_string($error)) {
        throw new InvalidArgumentException('Merged array can ontain only strings: ' . gettype($error) . ' found');
      }
      $this->errors[] = $error;
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
    return $this->errors;
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
    if (!is_string($value) && !$value instanceof ErrorMessages) {
      throw new InvalidArgumentException('Value must be a string or an object of type ' . ErrorMessages::class);
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

}
