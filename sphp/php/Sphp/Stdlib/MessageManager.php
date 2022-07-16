<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

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
   * @var array<string|int, string|array>
   */
  private array $messages;

  /**
   * @var array<string|int, string>
   */
  private array $templates = [];
  private array $parameters = [];

  /**
   * Constructor
   */
  public function __construct() {
    $this->templates = [];
    $this->messages = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->templates, $this->messages);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->messages = Arrays::copy($this->messages);
    $this->templates = Arrays::copy($this->templates);
  }

  public function setParameter(string $name, string|\Stringable|int|float|bool|null $value) {
    if (!str_starts_with($name, ':')) {
      $name = ":$name";
    }
    $this->parameters[$name] = $value;
  }

  /**
   * Checks whether a template is set or not
   * 
   * @param  string|int $id the id pointing to the template
   * @return bool true if template exists, otherwise false
   */
  public function containsTemplate(string|int $id): bool {
    return array_key_exists($id, $this->templates);
  }

  /**
   * Returns the template pointed by the given id
   * 
   * @param  string|int $id the id pointing to the template
   * @return string the template text
   * @throws InvalidArgumentException if the template does not exist
   */
  public function getTemplate(string|int $id): string {
    if (!$this->containsTemplate($id)) {
      throw new InvalidArgumentException("Template with id: '$id' does not exist");
    }
    return $this->templates[$id];
  }

  /**
   * Returns all message templates
   * 
   * @return string[] all message templates
   */
  public function getTemplates(): array {
    return $this->templates;
  }

  /**
   * Sets an id template pair
   * 
   * @param  string|int|null $id the id pointing to the template
   * @param  string $template the template text
   * @return $this for a fluent interface
   */
  public function setTemplate(string|int|null $id, string $template) {
    if ($id === null) {
      foreach (array_keys($this->templates) as $id) {
        $this->templates[$id] = $template;
      }
    } else {
      $this->templates[$id] = $template;
    }
    return $this;
  }

  /**
   * Creates and appends a message from a stored tempate
   * 
   * @param  string|int $id the id pointing to the template
   * @param  mixed... $params optional message parameters
   * @return $this for a fluent interface
   */
  public function appendMessageFromTemplate(string|int $id, ?array $params = null) {
    $this->setMessages(null, $this->buildMessageFromTemplate($id, $params));
    return $this;
  }

  private function filresParams(array $params): array {
    $array = $this->parameters;
    foreach ($params as $name => $value) {
      if (!str_starts_with($name, ':')) {
        $name = ":$name";
      }
      $array[$name] = $value;
    }
    return $array;
  }

  /**
   * Greates a new message string from template usig optional parameters
   * 
   * @param  string|int $id the id pointing to the template
   * @param  iterable<string, mixed> $params optional message parameters
   * @return string the message created
   */
  public function buildMessageFromTemplate(string|int $id, ?array $params = null): string {
    if ($params !== null) {
      $params = $this->filresParams($params);
    } else {
      $params = $this->parameters;
    }
    $out = str_replace(array_keys($params), array_values($params), $this->getTemplate($id));
    return $out;
  }

  /**
   * Appends messages
   * 
   * @param  string $messages the messages to append
   * @return $this for a fluent interface
   */
  public function append(string ... $messages) {
    foreach ($messages as $message) {
      $this->messages[] = $message;
    }
    return $this;
  }

  /**
   * Empties the collection
   *
   * @return $this for a fluent interface
   */
  public function unsetMessages() {
    $this->messages = [];
    return $this;
  }

  public function count(): int {
    $count = 0;
    foreach ($this->messages as $msg) {
      if ($msg instanceof MessageManager) {
        $count += $msg->count();
      } else {
        $count++;
      }
    }
    return $count;
  }

  public function containsMessage($offset): bool {
    return array_key_exists($offset, $this->messages);
  }

  /**
   * 
   * @param  string|int $offset
   * @return string|MessageManager|null
   */
  public function getMessages(string|int $offset): string|MessageManager|null {
    $out = null;
    if ($this->containsMessage($offset)) {
      $out = $this->messages[$offset];
    }
    return $out;
  }

  public function getFirstMessage(): ?string {
    if (empty($this->messages)) {
      return null;
    }
    $out = reset($this->messages);
    return $out;
  }

  /**
   * 
   * @param  string|int $id
   * @param  string|MessageManager $value
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function setMessages(string|int|null $id, string|MessageManager $value) {
    if ($id === null) {
      $this->messages[] = $value;
    } else {
      $this->messages[$id] = $value;
    }
    return $this;
  }

  /**
   * 
   * @param  string $templateId
   * @param  iterable<string, string|int|float>  $params
   * @param  string $messageId
   * @return $this for a fluent interface
   */
  public function setMessageFromTemplate(string|int $templateId, ?array $params = null, ?string $messageId = null) {
    if ($messageId === null) {
      $messageId = $templateId;
    }
    $this->setMessages($messageId, $this->buildMessageFromTemplate($templateId, $params));
    return $this;
  }

  /**
   * 
   * @param  string|int $id
   * @return $this for a fluent interface
   */
  public function removeMessage(string|int $id) {
    if ($this->containsMessage($id)) {
      unset($this->messages[$id]);
    }
    return $this;
  }

  /**
   * @inheritDoc
   * @return array<string|int, string|array>
   */
  public function toArray(): array {
    $obj = [];
    foreach ($this->messages as $key => $value) {
      if (is_string($value)) {
        $obj[$key] = $value;
      } else if ($value instanceof self) {
        $obj[$key] = $value->toArray();
      }
    }
    return $obj;
  }

  public function getIterator(): Traversable {
    yield from $this->messages;
  }

}
