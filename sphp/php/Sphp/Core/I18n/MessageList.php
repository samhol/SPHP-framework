<?php

/**
 * MessageList.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

use Sphp\Data\StablePriorityQueue;
use Sphp\Core\I18n\TranslatorInterface;
use Sphp\Core\I18n\Gettext\Translator;

/**
 * Class models a list that holds {@link Message} objects in a priority list
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-05-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MessageList implements \IteratorAggregate, TranslatorAwareInterface {

  use TranslatorAwareTrait;

  /**
   * Array that holds the messages
   *
   * @var  StablePriorityQueue
   */
  private $messages;

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
    $this->setTranslator($translator);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->messages);
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
  public function __toString() {
    $output = "";
    if ($this->count() > 0) {
      $output = self::class . ":\n";
      foreach (clone $this->messages as $message) {
        $output .= "\t" . $message . "\n";
      }
    } else {
      $output .= "Empty " . self::class;
    }
    return $output;
  }

  /**
   * Inserts new messages to the container
   *
   * **Important:** The message inserted becomes also a
   * {@link TranslatorChangerObserver} observers for the container
   *
   * @param  string $messageText the message text
   * @param  scalar[] $args arguments
   * @param  int $priority the priority of the message
   * @return self for PHP Method Chaining
   */
  public function insertMessage($messageText, array $args = [], $priority = 0) {
    $m = (new Message($messageText, $args));
    $this->insert($m, $priority);
    return $this;
  }

  /**
   * Inserts new messages to the container
   *
   * **Important:** The message inserted becomes also a
   * {@link TranslatorChangerObserver} observers for the container
   *
   * @param  Message $messages the message text
   * @param  int $priority the priority of the message
   * @return self for PHP Method Chaining
   */
  public function insert(Message $messages, $priority = 0) {
    if (!$this->exists($messages)) {
      $messages->setLang($this->getTranslator()->getLang());
      $this->messages->insert($messages, $priority);
    }
    return $this;
  }

  /**
   * Merges given {@link MessageList} to this container
   *
   * **Important:** The messages inserted become also a
   * {@link TranslatorChangerObserver} observers for the container
   *
   * @param  MessageList $m
   * @return self for PHP Method Chaining
   */
  public function merge(MessageList $m) {
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
    $arr = new \ArrayIterator();
    foreach (clone $this->messages as $message) {
      $arr[] = $message;
    }
    return $arr;
  }

  /**
   * Checks whether the given {@link Message} exists in the list
   *
   * @param  Message $message the message to search for
   * @return boolean true, if the {@link Message} exists, false otherwise
   */
  public function exists(Message $message) {
    $result = false;
    foreach (clone $this->messages as $m) {
      if ($message == $m) {
        $result = true;
      }
    }
    return $result;
  }

  /**
   * Counts the number of stored {@link Message} objects
   *
   * @return int the number of {@link Message} objects in the list
   */
  public function count() {
    return $this->messages->count();
  }

  /**
   * Returns the content as an array of formatted and localized message strings
   *
   * @return string[] the content as an array of formatted and localized message strings
   */
  public function toArray() {
    $output = [];
    foreach ($this as $message) {
      $output[] = $message->__toString();
    }
    return $output;
  }

  /**
   * Removes elements from the container
   *
   * @return self for PHP Method Chaining
   */
  public function clearContent() {
    $this->messages = new StablePriorityQueue();
    return $this;
  }

}
