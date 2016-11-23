<?php

/**
 * TopicList.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

use Sphp\Core\Types\Arrays;
use Sphp\Data\Collection;

/**
 * Class models a container for {@link MessageList} objects sorted by associated topics
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-08-21
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TopicList implements LanguageChangerChainInterface, \ArrayAccess, \IteratorAggregate {

  use LanguageChangerChainTrait;

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
   * The translator object translating the messages
   *
   * @var Translator
   */
  private $translator;

  /**
   * Constructs a new instance
   *
   * @param  Translator|null $translator the translator component
   */
  public function __construct(Translator $translator = null) {
    $this->topics = new Collection();
    if ($translator === null) {
      $translator = new Translator();
    }
    $this->translator = $translator;
  }

  public function getTranslator() {
    return $this->translator;
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

  /**
   * Checks whether the given {@link Message} exists in the list
   *
   * **NOTE:** optionally a search can be restricted by giving a message topic
   *  as a second parameter
   *
   * @param  Message $message the message to search for
   * @param  scalar|null $topic the topic of the message
   * @return boolean true, if the topic exists, false otherwise
   */
  public function messageExists(Message $message, $topic = null) {
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
    $this->topics = Arrays::copy($this->topics);
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

  /**
   * Checks whether an topic exists
   *
   * @param  string $topic the message topic
   * @return boolean true, if the topic exists, false otherwise
   * @uses   self::offsetExists()
   */
  public function exists($topic) {
    return $this->offsetExists($topic);
  }

  /**
   * Returns the {@link MessageList} of a specific topic
   *
   * @param  string $topic the topic to fetch
   * @return MessageList|null the topic or null if no topic was found
   */
  public function offsetGet($topic) {
    return $this->topics->offsetGet($topic);
  }

  /**
   * Returns the {@link MessageList} object of a specific topic
   *
   * @param  string $topic the topic to fetch
   * @return MessageList|null the topic or null if no topic was found
   * @uses   self::offsetGet()
   */
  public function get($topic) {
    return clone $this->offsetGet($topic);
    ;
  }

  /**
   * Sets a new topic with messages inside a {@link MessageList}
   *
   * **Important:** The {@link Message} or the {@link MessageList} inserted
   *  becomes also a {@link TranslatorChangerObserver} observer for the container
   *
   * @param  string $topic the message topic
   * @param  Message|MessageList $m message or message list
   * @throws \InvalidArgumentException if the type of the inserted data is illegal
   */
  public function offsetSet($topic, $m) {
    if ($m instanceof Message) {
      $m = (new MessageList($this->getTranslator()))->insert($m);
    }
    if (!($m instanceof MessageList)) {
      throw new \InvalidArgumentException();
    }
    $m->setLang($this->getTranslator()->getLang());
    $this->registerLanguageChangerObserver($m);
    $this->topics->offsetSet($topic, $m);
  }

  /**
   * Sets a new topic with messages
   *
   * **Important:** The {@link Message} or the {@link MessageList} inserted
   *  becomes also a {@link TranslatorChangerObserver} observer for the container
   *
   * @param  string $topic the message topic
   * @param  Message|MessageList $m message or message list
   * @return self for PHP Method Chaining
   * @uses   self::offsetSet()
   * @throws \InvalidArgumentException if the type of the inserted data is illegal
   */
  public function set($topic, MessageList $m) {
    $this->offsetSet($topic, $m);
    return $this;
  }

  /**
   * Removes a message topic from the container
   *
   * @param  string $topic the message topic to be removed
   */
  public function offsetUnset($topic) {
    if ($this->offsetExists($topic)) {
      $this->unregisterTranslatorChangerObserver($this->offsetGet($topic));
    }
    $this->topics->offsetUnset($topic);
  }

}
