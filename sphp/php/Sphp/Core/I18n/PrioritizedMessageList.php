<?php

/**
 * PrioritizedMessageList.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

use Sphp\Data\StablePriorityQueue;
use Sphp\Core\I18n\TranslatorInterface;
use Sphp\Core\I18n\Gettext\Translator;
use IteratorAggregate;

/**
 * Inmplements a list that holds {@link MessageInterface} objects in a priority list
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-05-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PrioritizedMessageList implements IteratorAggregate, MessageCollectionInterface {

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
   * Inserts new messages object to the container
   *
   * **Important:** The message inserted becomes also a
   * {@link TranslatorChangerObserver} observers for the container
   *
   * @param  string $messageText the message text
   * @param  scalar[] $args arguments
   * @param  int $priority the priority of the message
   * @return self for PHP Method Chaining
   */
  public function insertMessage($messageText, $args = null, $priority = 0) {
    $m = (new Message($messageText, $args, false, $this->getTranslator()));
    $this->insert($m, $priority);
    return $this;
  }

  /**
   * Inserts new messages to the container
   *
   * @param  MessageInterface $messages the message text
   * @param  int $priority the priority of the message
   * @return self for PHP Method Chaining
   */
  public function insert(MessageInterface $messages, $priority = 0) {
    $messages->setLang($this->getLang());
    $this->messages->insert($messages, $priority);
    return $this;
  }

  /**
   * Merges given {@link MessageList} to this container
   *
   * @param  PrioritizedMessageList $m
   * @return self for PHP Method Chaining
   */
  public function merge(PrioritizedMessageList $m) {
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
