<?php

/**
 * MessageList.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n;

use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Gettext\Translator;
use Iterator;

/**
 * Implements a list that holds {@link MessageInterface} objects in a priority list
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-05-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MessageList implements Iterator, MessageCollectionInterface {

  /**
   * Array that holds the messages
   *
   * @var MessageInterface[]
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
    $this->messages = [];
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
    foreach ($this->messages as $message) {
      $this->messages[] = clone $message;
    }
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
      foreach ($this->messages as $message) {
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

  public function setLang($lang) {
    $this->getTranslator()->setLang($lang);
    foreach ($this as $message) {
      $message->setLang($lang);
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
   * Appends new messages object to the container
   *
   * @param  string $messageText the message text
   * @param  scalar[] $args arguments
   * @return self for a fluent interface
   */
  public function appendMessage($messageText, $args = null) {
    $m = (new Message($messageText, $args, false, $this->getTranslator()));
    $this->append($m);
    return $this;
  }

  /**
   * Inserts a messages to the container
   *
   * @param  MessageInterface $message the message text
   * @return self for a fluent interface
   */
  public function insert(MessageInterface $message) {
    $message->setLang($this->getLang());
    $this->append($message);
    return $this;
  }

  /**
   * Appends new messages to the container
   *
   * @param  MessageInterface $message the message text
   * @param  int $priority the priority of the message
   * @return self for a fluent interface
   */
  public function append(MessageInterface $message) {
    $message->setLang($this->getLang());
    $this->messages[] = $message;
    return $this;
  }
  
  /**
   * Merges given collection to this container
   *
   * @param  MessageCollectionInterface $m
   * @return self for a fluent interface
   */
  public function merge(MessageCollectionInterface $m) {
    foreach ($m as $message) {
      $this->insert($message);
    }
    return $this;
  }

  public function contains(MessageInterface $message) {
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
  public function count() {
    return count($this->messages);
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
   * @return self for a fluent interface
   */
  public function clearContent() {
    $this->messages = [];
    return $this;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->messages);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->messages);
  }

  /**
   * Return the key of the current message
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->messages);
  }

  /**
   * Rewinds the Iterator to the first message
   */
  public function rewind() {
    reset($this->messages);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid() {
    return false !== current($this->messages);
  }

}
