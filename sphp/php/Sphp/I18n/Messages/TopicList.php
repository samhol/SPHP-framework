<?php

/**
 * TopicList.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n\Messages;

use Sphp\I18n\TranslatorInterface;
use Iterator;
use ArrayAccess;
use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\I18n\Translatable;
use Sphp\Stdlib\Arrays;

/**
 * Implements a container for translatable objects sorted by associated topics
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-08-21
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TopicList implements Iterator, Translatable, Arrayable, Countable, ArrayAccess {

  /**
   * Count mode (topics only)
   */
  const COUNT_TOPICS = 0;

  /**
   * Count mode (all stored messages)
   */
  const COUNT_MESSAGES = 1;

  /**
   * @var MessageCollectionInterface[]
   */
  private $topics;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    $this->topics = [];
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->topics);
  }

  public function __toString(): string {
    return $this->translate();
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->topics = Arrays::copy($this->topics);
    parent::__clone();
  }

  /**
   * Merges given {@link TopicList} to this container
   *
   * @param  TopicList $tc the container to merge
   * @return self for a fluent interface
   */
  public function merge(TopicList $tc) {
    foreach ($tc->getTopics() as $topic => $cont) {
      if ($this->offsetExists($topic)) {
        $this->offsetGet($topic)->merge($cont);
      } else {
        $this->offsetSet($topic, $cont);
      }
    }
    return $this;
  }

  /**
   * Returns the contained topics
   *
   * @return string[] an array containing the topic names
   */
  public function getTopics(): array {
    return array_keys($this->topics);
  }

  public function messageExists(MessageInterface $message, $topic = null): bool {
    if ($message === null) {
      foreach ($this as $topic) {
        if ($topic->exists($message)) {
          return true;
        }
      }
      return false;
    } else {
      return $this->offsetExists($topic) && $this[$topic]->exists($message);
    }
  }

  /**
   * Counts the number of stored collections or messages
   *
   * @param  int $mode the count mode
   * @return int the number of {@link MessageTopic} or {@link Message} objects stored
   */
  public function count(int $mode = self::COUNT_TOPICS): int {
    if ($mode == self::COUNT_MESSAGES) {
      $r = 0;
      foreach ($this->topics as $cont) {
        $r += $cont->count();
      }
      return $r;
    } else {
      return count($this->topics);
    }
  }

  /**
   * Removes elements from MessageList
   *
   *  The optional `$topic` attribute narrows down the clearing to the messages of given target element.
   *
   * @param string $topic optional topic name
   * @return self for a fluent interface
   */
  public function clearContent(string $topic = null) {
    if ($topic === null) {
      $this->topics = [];
    } else if ($this->offsetExists($topic)) {
      $this->offsetUnset($topic);
    }
    return $this;
  }

  /**
   * Checks whether an topic exists
   *
   * @param  string $topic the message topic
   * @return boolean true, if the topic exists, false otherwise
   */
  public function offsetExists($topic): bool {
    return array_key_exists($topic, $this->topics);
  }

  public function contains(Translatable $message): bool {
    $result = false;
    foreach ($this as $mList) {
      if ($mList->exists($message)) {
        $result = true;
        break;
      }
    }
    return $result;
  }

  /**
   * Returns the content as an array of formatted and localized message strings
   *
   * @return array the content as an array of formatted and localized message strings
   */
  public function toArray(): array {
    $output = [];
    foreach ($this as $topic => $list) {
      $output[$topic] = $list->toArray();
    }
    return $output;
  }

  /**
   * Returns the {@link MessageList} of a specific topic
   *
   * @param  string $topic the topic to fetch
   * @return TranslatableCollectionInterface|null the topic or null if no topic was found
   */
  public function offsetGet($topic) {
    if ($this->offsetExists($topic)) {
      return $this->topics[$topic];
    }
    return null;
  }

  /**
   * Returns the {@link MessageList} object of a specific topic
   *
   * @param  string $topic the topic to fetch
   * @return TranslatableCollectionInterface|null the topic or null if no topic was found
   * @uses   self::offsetGet()
   */
  public function get(string $topic) {
    return $this->offsetGet($topic);
  }

  /**
   * Sets a new topic with messages inside a {@link MessageList}
   *
   * **Important:** The {@link Message} or the {@link MessageList} inserted
   *  becomes also a {@link TranslatorChangerObserver} observer for the container
   *
   * @param  string $topic the message topic
   * @param  mixed $m message or message list
   * @return self for a fluent interface
   */
  public function offsetSet($topic, $m) {
    if (!$m instanceof TranslatableCollectionInterface) {
      $m = (new TranslatableList())->insert($m);
    }
    $this->topics[$topic] = $m;
    return $this;
  }

  /**
   * Sets a new topic with messages
   *
   * **Important:** The {@link Message} or the {@link MessageList} inserted
   *  becomes also a {@link TranslatorChangerObserver} observer for the container
   *
   * @param  string $topic the message topic
   * @param  mixed $m message or message list
   * @return self for a fluent interface
   * @uses   self::offsetSet()
   */
  public function set(string $topic, $m) {
    $this->offsetSet($topic, $m);
    return $this;
  }

  /**
   * Removes a message topic from the container
   *
   * @param  string $topic the message topic to be removed
   * @return self for a fluent interface
   */
  public function offsetUnset($topic) {
    if ($this->offsetExists($topic)) {
      $this->unregisterTranslatorChangerObserver($this->offsetGet($topic));
      unset($this->topics[$topic]);
    }
    return $this;
  }

  public function setTranslator(TranslatorInterface $translator) {
    foreach ($this as $component) {
      if ($component instanceof Translatable) {
        $component->setTranslator($translator);
      }
    }
    return $this;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->topics);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->topics);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->topics);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->topics);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid() {
    return false !== current($this->topics);
  }

  public function translate(): string {
    $output = '';
    foreach ($this as $component) {
      $output .= $component;
    }
    return $output;
  }

  public function translateTo(string $lang): string {
    $output = '';
    foreach ($this as $component) {
      if ($component instanceof Translatable) {
        $output .= $component->translateTo($lang);
      } else {
        $output .= $component;
      }
    }
    return $output;
  }

}
