<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use IteratorAggregate;
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
class MessageManager implements IteratorAggregate, Countable, Arrayable {

  /**
   * stored error messages
   *
   * @var array<string|int, string|ErrorMessages>
   */
  private array $errors;

  /**
   * @var string[] 
   */
  private array $templates = [];

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
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
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
   * Creates and appends a message from a stored tempate
   * 
   * @param  string $templateId the id pointing to the template
   * @param  mixed... $params optional message parameters
   * @return $this for a fluent interface
   */
  public function appendMessageFromTemplate(string $templateId, ... $params) {
    $this->setMessage(null, $this->buildMessageFromTemplate($templateId, ...$params));
    return $this;
  }

  /**
   * Greates a new message string from template usig optional parameters
   * 
   * @param  string $templateId the id pointing to the template
   * @param  mixed ... $params optional message parameters
   * @return string the message created
   */
  public function buildMessageFromTemplate(string $templateId, ... $params): string {
    return vsprintf($this->getTemplate($templateId), $params);
  }

  /**
   * Appends an error message
   * 
   * @param  string|array|MessageManager $content the content to append
   * @return $this for a fluent interface
   */
  public function append($content) {
    $this->setMessage(null, $content);
    return $this;
  }

  /**
   * Merges a collection of error messages 
   * 
   * @param  array|Traversable $errors collection to merge
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the merging fails
   */
  public function mergeCollection(iterable $errors) {
    foreach ($errors as $error) {
      $this->append($error);
    }
    return $this;
  }

  /**
   * Empties the collection
   *
   * @return $this for a fluent interface
   */
  public function unsetMessages() {
    $this->errors = [];
    return $this;
  }

  public function toArray(): array {
    $arr = [];
    foreach ($this as $key => $value) {
      if ($value instanceof MessageManager) {
        $arr[$key] = $value->toArray();
      } else {
        $arr[$key] = $value;
      }
    }
    return $arr;
  }

  public function count(bool $recursive = true): int {
    if ($recursive) {
      $counter = function (int $count, $x) use ($recursive) {
        if ($x instanceof MessageManager) {
          $count += $x->count($recursive);
        } else {
          $count += 1;
        }
        return $count;
      };
      $count = array_reduce($this->errors, $counter, 0);
    } else {

      $count = count($this->errors);
    }
    return $count;
  }

  public function containsMessage($offset): bool {
    return array_key_exists($offset, $this->errors);
  }

  /**
   * 
   * @param  string|int $offset
   * @return string|MessageManager|null
   */
  public function getMessage($offset) {
    $out = null;
    if ($this->containsMessage($offset)) {
      $out = $this->errors[$offset];
    }
    return $out;
  }

  /**
   * 
   * @param  string|int $offset
   * @param  string|MessageManager $value
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function setMessage($offset, $value) {
    if (is_array($value)) {
      $value = static::fromTraversable($value);
    }
    if (!$value instanceof MessageManager && !is_string($value)) {
      throw new InvalidArgumentException('Tried to set content of type: ' . gettype($value));
    }
    if ($offset === null) {
      $this->errors[] = $value;
    } else {
      $this->errors[$offset] = $value;
    }
    return $this;
  }

  /**
   * Sets the error message 
   * 
   * @param  string $id the id pointing to the template
   * @param  mixed... $params optional message parameters
   * @return $this for a fluent interface
   */

  /**
   * 
   * @param  string $messageId
   * @param  string $templateId
   * @param  type $params
   * @return $this for a fluent interface
   */
  public function setMessageFromTemplate(string $messageId, string $templateId, ... $params) {
    $this->setMessage($messageId, $this->buildMessageFromTemplate($templateId, ...$params));
    return $this;
  }

  /**
   * 
   * @param  string|int $offset
   * @return $this for a fluent interface
   */
  public function removeMessage($offset) {
    if ($this->containsMessage($offset)) {
      unset($this->errors[$offset]);
    }
    return $this;
  }

  public static function fromTraversable($data): MessageManager {
    if ($data instanceof Traversable) {
      $data = iterator_to_array($data, true);
    }
    $obj = new static();
    foreach ($data as $key => $value) {
      $obj->setMessage($key, $value);
    }
    return $obj;
  }

  public function getIterator(): Traversable {
    yield from $this->errors;
  }

}
