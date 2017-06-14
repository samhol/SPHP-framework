<?php

/**
 * TranslatableCollectionInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n\Messages;

use Traversable;
use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\I18n\Translatable;

/**
 * Defines properties for a collection that holds {@link MessageInterface} objects
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-05-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TranslatableCollectionInterface extends Traversable, Translatable, Arrayable, Countable {

  /**
   * Checks whether the given translatable object exists in this collection
   *
   * @param  MessageInterface $translatable the object to search for
   * @return boolean true, if the message exists, false otherwise
   */
  public function contains(Translatable $translatable): bool;

  /**
   * Merges given collection to this collection
   *
   * @param  MessageCollectionInterface $m
   * @return self for a fluent interface
   */
  public function merge(TranslatableCollectionInterface $m);
}
