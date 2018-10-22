<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n\Collections;

use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Gettext\Translator;
use Iterator;
use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\I18n\Translatable;
use ArrayAccess;
use Sphp\I18n\Messages\Msg;
use Sphp\Exceptions\InvalidArgumentException;
use Traversable;

/**
 * Implements a list that holds {@link Translatable} objects in a priority list
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TranslatableCollection implements Iterator, TranslatableCollectionInterface, ArrayAccess, Countable, Arrayable {

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
   * Constructor
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

  public function getTranslator(): TranslatorInterface {
    return $this->translator;
  }

  public function setTranslator(TranslatorInterface $translator) {
    $this->translator = $translator;
    foreach ($this as $message) {
      $message->setTranslator($translator);
    }
    return $this;
  }

  /**
   * Appends new messages to the container
   *
   * @param  Translatable $translatable the message text
   * @return $this for a fluent interface
   */
  public function append(Translatable $translatable) {
    $this->translatables[] = $translatable;
    return $this;
  }

  /**
   * Merges given collection to this container
   *
   * @param  Traversable|array $translatables
   * @return $this for a fluent interface
   */
  public function merge(TranslatableCollection $translatables) {
    foreach ($translatables as $message) {
      $this->append($message);
    }
    return $this;
  }

  /**
   * Merges given collection to this collection
   *
   * @param  Translatable $translatable
   * @return $this for a fluent interface
   */
  public function contains(Translatable $translatable): bool {
    $result = false;
    foreach ($this as $m) {
      if ($translatable == $m) {
        $result = true;
        break;
      }
    }
    return $result;
  }

  /**
   * Counts the number of stored translatable objects
   *
   * @return int the number of Translatable objects in the list
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
    foreach ($this as $offset => $translatable) {
      if ($translatable instanceof Translatable) {
        $output[$offset] = $translatable->translateWith($translator);
      } else {
        $output[$offset] = $translatable;
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
   * @param  string $offset the offset
   * @param  mixed $translatable translatable object or a string
   */
  public function offsetSet($offset, $translatable) {
    if (is_string($translatable)) {
      $translatable = Msg::singular($translatable);
    }
    if (!$translatable instanceof Translatable) {
      throw new InvalidArgumentException();
    }
    $this->translatables[$offset] = $translatable;
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
   * @param  string $offset An offset to check for.
   * @return boolean true on success or false on failure
   */
  public function offsetExists($offset): bool {
    return array_key_exists($offset, $this->translatables);
  }

}
