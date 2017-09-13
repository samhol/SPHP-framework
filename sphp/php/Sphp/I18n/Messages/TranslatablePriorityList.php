<?php

/**
 * TranslatablePriorityList.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n\Messages;

use Sphp\Stdlib\Datastructures\StablePriorityQueue;
use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Gettext\Translator;
use IteratorAggregate;
use Zend\Stdlib\PriorityList;
use Sphp\I18n\Translatable;
use Sphp\Stdlib\Arrays;

/**
 * Implements a list that holds {@link MessageInterface} objects in a priority list
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-05-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TranslatablePriorityList implements IteratorAggregate, TranslatableCollectionInterface {

  /**
   * Array that holds the messages
   *
   * @var StablePriorityQueue
   */
  private $messages;

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
    $this->messages = new StablePriorityQueue();
    if ($translator === null) {
      $translator = new Translator();
    }
    $a = new PriorityList();
    $this->setTranslator($translator);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->messages, $this->translator);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->messages = clone $this->messages;
  }

  /**
   * Returns the object as a string.
   *
   * @return string the object as a string
   */
  public function __toString(): string {
    return $this->translate();
  }

  public function getTranslator() {
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
   * Inserts new messages to the container
   *
   * @param  MessageInterface $messages the message text
   * @param  int $priority the priority of the message
   * @return $this for a fluent interface
   */
  public function insert(Translatable $messages, int $priority = 0) {
    $this->messages->insert($messages, $priority);
    return $this;
  }

  /**
   * Merges given collection to this container
   *
   * @param  MessageCollectionInterface $m
   * @return $this for a fluent interface
   */
  public function merge(TranslatableCollectionInterface $m) {
    foreach ($m as $message) {
      $this->insert($message);
    }
    return $this;
  }

  /**
   * Create a new iterator from the instance
   *
   * @return \ArrayIterator iterator
   */
  public function getIterator() {
    return clone $this->messages;
  }

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
   * Counts the number of stored message objects
   *
   * @return int the number of {@link MessageInterface} objects in the list
   */
  public function count(): int {
    return $this->messages->count();
  }

  /**
   * Returns the content as an array of formatted and localized message strings
   *
   * @return string[] the content as an array of formatted and localized message strings
   */
  public function toArray(): array {
    $output = [];
    foreach ($this as $message) {
      $output[] = "$message";
    }
    return $output;
  }

  /**
   * Removes elements from the container
   *
   * @return $this for a fluent interface
   */
  public function clearContent() {
    $this->messages = new StablePriorityQueue();
    return $this;
  }

  public function translate(): string {
    $output = '';
    foreach ($this as $component) {
      $output .= $component;
    }
    return $output;
  }

  public function translateWith(TranslatorInterface $translator): string {
    $output = '';
    foreach ($this as $component) {
      if ($component instanceof Translatable) {
        $output .= $component->translateWith($translator);
      } else {
        $output .= $component;
      }
    }
    return $output;
  }

}
