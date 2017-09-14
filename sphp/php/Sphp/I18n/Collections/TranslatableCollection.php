<?php

/**
 * MessageList.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n\Collections;

use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Gettext\Translator;
use Iterator;
use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\I18n\Translatable;
use ArrayAccess;

/**
 * Implements a list that holds {@link MessageInterface} objects in a priority list
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-05-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TranslatableCollection implements Iterator, TranslatableCollectionInterface, ArrayAccess, Arrayable, Countable {

  /**
   * Array that holds the messages
   *
   * @var Translatable[]
   */
  private $translatables;

  /**
   * the inner translator 
   *
   * @var TranslatorInterface
   */
  private $translator;

  /**
   * Constructs a new instance
   *
   * @param  TranslatorInterface|null $translator the translator component
   */
  public function __construct(TranslatorInterface $translator = null) {
    $this->translatables = [];
    if ($translator === null) {
      $translator = new Translator();
    }
    $this->setTranslator($translator);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->translatables, $this->translator);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    foreach ($this->translatables as $message) {
      $this->translatables[] = clone $message;
    }
  }

  public function __toString(): string {
    $output = "";
    if ($this->count() > 0) {
      foreach ($this->translatables as $message) {
        $output .= "\t" . $message . "\n";
      }
    } else {
      $output .= "Empty " . self::class;
    }
    return $output;
  }

  public function getLang() {
    return $this->getTranslator()->getLang();
  }

  public function getTranslator() {
    return $this->translator;
  }

  public function setLang(string $lang) {
    $this->getTranslator()->setLang($lang);
    foreach ($this as $message) {
      //$message->setLang($lang);
    }
    return $this;
  }

  public function setTranslator(TranslatorInterface $translator) {
    $this->translator = $translator;
    foreach ($this as $message) {
      $message->setTranslator($translator);
    }
    return $this;
  }

  /**
   * Inserts a messages to the container
   *
   * @param  Translatable $message the message text
   * @return $this for a fluent interface
   */
  public function insert(Translatable $message) {
    $this->append($message);
    return $this;
  }

  /**
   * Appends new messages to the container
   *
   * @param  MessageInterface $message the message text
   * @param  int $priority the priority of the message
   * @return $this for a fluent interface
   */
  public function append(Translatable $message) {
    $this->translatables[] = $message;
    return $this;
  }

  /**
   * Merges given collection to this container
   *
   * @param  MessageCollectionInterface $m
   * @return $this for a fluent interface
   */
  public function merge(TranslatableCollection $m) {
    foreach ($m as $message) {
      $this->insert($message);
    }
    return $this;
  }

  /**
   * Merges given collection to this collection
   *
   * @param  MessageCollectionInterface $m
   * @return $this for a fluent interface
   */
  public function contains(Translatable $message): bool {
    $result = false;
    foreach ($this as $m) {
      if ($message == $m) {
        $result = true;
        break;
      }
    }
    return $result;
  }

  /**
   * Counts the number of stored translatable objects
   *
   * @return int the number of {@link Translatable} objects in the list
   */
  public function count(): int {
    return count($this->translatables);
  }

  /**
   * Returns the content as an array of formatted and localized strings
   *
   * @return string[] the content as an array of formatted and localized strings
   */
  public function toArray(): array {
    return $this->translate();
  }

  /**
   * Removes elements from the container
   *
   * @return $this for a fluent interface
   */
  public function clearContent() {
    $this->translatables = [];
    return $this;
  }

  /**
   * Returns the current translatable object
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->translatables);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->translatables);
  }

  /**
   * Return the key of the current translatable object
   * 
   * @return mixed the key of the current translatable object
   */
  public function key() {
    return key($this->translatables);
  }

  /**
   * Rewinds the Iterator to the first translatable object
   */
  public function rewind() {
    reset($this->translatables);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->translatables);
  }

  public function translate(): array {
    return $this->translateWith($this->getTranslator());
  }

  public function translateWith(TranslatorInterface $translator): array {
    $output = [];
    foreach ($this as $offset => $component) {
      if ($component instanceof Translatable) {
        $output[$offset] = $component->translateWith($translator);
      } else {
        $output[$offset] = $component;
      }
    }
    return $output;
  }

  /**
   * Returns the Translatable at the offset
   *
   * @param  string $offset the topic to fetch
   * @return Translatable|null the translatable or null if no translatable was found
   */
  public function offsetGet($offset) {
    if ($this->offsetExists($offset)) {
      return $this->translatables[$offset];
    }
    return null;
  }

  /**
   * Sets a translatable object to the given offset
   *
   * **Important:** The {@link Message} or the {@link MessageList} inserted
   *  becomes also a {@link TranslatorChangerObserver} observer for the container
   *
   * @param  string $offset the message topic
   * @param  mixed $m translatable object or a string
   */
  public function offsetSet($offset, $m) {
    if (!$m instanceof Translatable) {
      $m = Message::singular($m);
    }
    $this->translatables[$offset] = $m;
  }

  /**
   * Removes an offset from the container
   *
   * @param  string $offset the offset to be removed
   */
  public function offsetUnset($offset) {
    if ($this->offsetExists($offset)) {
      unset($this->translatables[$offset]);
    }
  }

  /**
   * Checks whether an topic exists
   *
   * @param  string $offset the message topic
   * @return boolean true, if the topic exists, false otherwise
   */
  public function offsetExists($offset): bool {
    return array_key_exists($offset, $this->translatables);
  }

}
