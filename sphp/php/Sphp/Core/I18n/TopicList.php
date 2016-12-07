<?php

/**
 * TopicList.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

use Sphp\Core\I18n\TranslatorInterface;
use Sphp\Core\I18n\Gettext\Translator;
use Sphp\Data\Collection;
use IteratorAggregate;
use ArrayAccess;

/**
 * Implements a container for {@link MessageList} objects sorted by associated topics
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-08-21
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TopicList implements IteratorAggregate, ArrayAccess, MessageCollectionInterface {

  /**
   * Count mode (topics only)
   */
  const COUNT_TOPICS = 0;

  /**
   * Count mode (all stored messages)
   */
  const COUNT_MESSAGES = 1;

  /**
   * container for the {@link MessageList} objects
   *
   * @var Collection
   */
  private $topics;

  /**
   * the inner translator 
   *
   * @var TranslatorInterface
   */
  private $translator;

  /**
   * Constructs a new instance
   *
   * @param  Translator|null $translator the translator component
   */
  public function __construct(TranslatorInterface $translator = null) {
    $this->topics = new Collection();
    if ($translator === null) {
      $translator = new Translator();
    }
    $this->setTranslator($translator);
  }

  /**
   * Merges given {@link TopicList} to this container
   *
   * @param  TopicList $tc the container to merge
   * @return self for PHP Method Chaining
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
   * Create a new iterator to iterate through the {@link MessageList} objects
   *
   * @return Collection iterator
   */
  public function getIterator() {
    return $this->topics;
  }

  /**
   * Returns the contained topics
   *
   * @return string[] an array containing the topic names
   */
  public function getTopics() {
    return array_keys($this->topics);
  }

  public function messageExists(MessageInterface $message, $topic = null) {
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
   * Counts the number of stored {@link Message} objects.
   *
   * @param  int $mode the count mode
   * @return int the number of {@link MessageTopic} or {@link Message} objects stored
   */
  public function count($mode = self::COUNT_TOPICS) {
    if ($mode == self::COUNT_MESSAGES) {
      $r = 0;
      foreach ($this->topics as $cont) {
        $r += $cont->count();
      }
      return $r;
    } else {
      return $this->topics->count();
    }
  }

  /**
   * Returns the object as a string.
   *
   * @return string the object as a string
   */
  public function __toString() {
    $output = "";
    if ($this->count(self::COUNT_TOPICS) > 0) {
      $output = self::class . ":\n";
      foreach ($this->topics as $topic => $messages) {
        $output .= "\t$topic:\n";
        foreach ($messages as $message) {
          $output .= "\t\t$message\n";
        }
      }
    } else {
      $output .= "Empty " . self::class;
    }
    return $output;
  }

  /**
   * Removes elements from MessageList.
   *
   *  The optional `$topic` attribute narrows down the clearing to the messages of given target element.
   *
   * @param string $topic optional topic name
   * @return self for PHP Method Chaining
   */
  public function clearContent($topic = null) {
    if ($topic === null) {
      $this->topics->clear();
    } else if ($this->offsetExists($topic)) {
      $this->offsetUnset($topic);
    }
    return $this;
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->topics = clone $this->topics;
    parent::__clone();
  }

  /**
   * Checks whether an topic exists
   *
   * @param  string $topic the message topic
   * @return boolean true, if the topic exists, false otherwise
   */
  public function offsetExists($topic) {
    //var_dump($topic);
    return $this->topics->offsetExists($topic);
  }

  public function contains(MessageInterface $message) {
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
   * Returns the {@link MessageList} of a specific topic
   *
   * @param  string $topic the topic to fetch
   * @return PrioritizedMessageList|null the topic or null if no topic was found
   */
  public function offsetGet($topic) {
    return $this->topics->offsetGet($topic);
  }

  /**
   * Returns the {@link MessageList} object of a specific topic
   *
   * @param  string $topic the topic to fetch
   * @return PrioritizedMessageList|null the topic or null if no topic was found
   * @uses   self::offsetGet()
   */
  public function get($topic) {
    return $this->offsetGet($topic);
  }

  /**
   * Sets a new topic with messages inside a {@link MessageList}
   *
   * **Important:** The {@link Message} or the {@link MessageList} inserted
   *  becomes also a {@link TranslatorChangerObserver} observer for the container
   *
   * @param  string $topic the message topic
   * @param  MessageInterface|PrioritizedMessageList $m message or message list
   * @return self for PHP Method Chaining
   * @throws \InvalidArgumentException if the type of the inserted data is illegal
   */
  public function offsetSet($topic, $m) {
    if ($m instanceof MessageInterface) {
      $m = (new PrioritizedMessageList($this->getTranslator()))->insert($m);
    }
    if (!($m instanceof PrioritizedMessageList)) {
      throw new \InvalidArgumentException();
    }
    $m->setLang($this->getTranslator()->getLang());
    $this->topics->offsetSet($topic, $m);
    return $this;
  }

  /**
   * Sets a new topic with messages
   *
   * **Important:** The {@link Message} or the {@link MessageList} inserted
   *  becomes also a {@link TranslatorChangerObserver} observer for the container
   *
   * @param  string $topic the message topic
   * @param  Message|PrioritizedMessageList $m message or message list
   * @return self for PHP Method Chaining
   * @uses   self::offsetSet()
   * @throws \InvalidArgumentException if the type of the inserted data is illegal
   */
  public function set($topic, PrioritizedMessageList $m) {
    $this->offsetSet($topic, $m);
    return $this;
  }

  /**
   * Removes a message topic from the container
   *
   * @param  string $topic the message topic to be removed
   * @return self for PHP Method Chaining
   */
  public function offsetUnset($topic) {
    if ($this->offsetExists($topic)) {
      $this->unregisterTranslatorChangerObserver($this->offsetGet($topic));
    }
    $this->topics->offsetUnset($topic);
    return $this;
  }

  public function getLang() {
    return $this->getTranslator()->getLang();
  }

  public function getTranslator() {
    return $this->translator;
  }

  public function setLang($lang) {
    $this->getTranslator()->setLang($lang);
    foreach ($this as $mlist) {
      $mlist->setLang($lang);
    }
    return $this;
  }

  public function setTranslator(TranslatorInterface $translator) {
    $this->translator = $translator;
    foreach ($this as $mlist) {
      $mlist->setTranslator($translator);
    }
    return $this;
  }

}
