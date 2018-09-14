<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n\Collections;

use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Gettext\Translator;
use IteratorAggregate;
use Sphp\I18n\Translatable;
use Sphp\Stdlib\Datastructures\PriorityQueue;
use Traversable;

/**
 * Implements a list that holds {@link Translatable} objects in a reusable priority queue
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TranslatablePriorityList implements IteratorAggregate, TranslatableCollectionInterface, Arrayable {

  /**
   * Array that holds the messages
   *
   * @var PriorityQueue
   */
  private $messages;

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
    $this->messages = new PriorityQueue();
    //$this->messages->setInternalQueueClass(StablePriorityQueue::class);
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
   * @param  Translatable $messages the message text
   * @param  int $priority the priority of the message
   * @return $this for a fluent interface
   */
  public function insert(Translatable $messages, int $priority = 0) {
    $this->messages->enqueue($messages, $priority);
    return $this;
  }

  /**
   * Create a new iterator from the instance
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return clone $this->messages->getIterator();
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
   * Removes elements from the container
   *
   * @return $this for a fluent interface
   */
  public function clearContent() {
    $this->messages = new PriorityQueue();
    return $this;
  }

  public function translate(): array {
    return $this->translateWith($this->getTranslator());
  }

  public function translateWith(TranslatorInterface $translator): array {
    $output = [];
    foreach ($this as $component) {
      if ($component instanceof Translatable) {
        $output[] = $component->translateWith($translator);
      } else {
        $output[] = $component;
      }
    }
    return $output;
  }

  /**
   * Returns the content as an array of formatted and localized message strings
   *
   * @return string[] the content as an array of formatted and localized message strings
   */
  public function toArray(): array {
    return $this->translate();
  }

}
