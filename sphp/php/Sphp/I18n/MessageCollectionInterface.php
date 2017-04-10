<?php

/**
 * MessageCollectionInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n;

use Traversable;
use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Defines properties for a collection that holds {@link MessageInterface} objects
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-05-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface MessageCollectionInterface extends Traversable, TranslatorAwareInterface, Arrayable, Countable {

  /**
   * Checks whether the given message exists in the collection
   *
   * @param  MessageInterface $message the message to search for
   * @return boolean true, if the message exists, false otherwise
   */
  public function contains(MessageInterface $message);

  /**
   * Inserts a new message to the collection
   *
   * @param  MessageInterface $m
   * @return self for a fluent interface
   */
  public function insert(MessageInterface $m);

  /**
   * Merges given collection to this collection
   *
   * @param  MessageCollectionInterface $m
   * @return self for a fluent interface
   */
  public function merge(MessageCollectionInterface $m);
}
