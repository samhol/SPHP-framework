<?php

/**
 * MessageCollectionInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

use Traversable;
use Countable;
use Sphp\Data\Arrayable;

/**
 * Defines propertiws for a collection that holds {@link MessageInterface} objects
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-05-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface MessageCollectionInterface extends Traversable, TranslatorAwareInterface, Arrayable, Countable {

  /**
   * Returns the object as a string.
   *
   * @return string the object as a string
   */
  public function __toString();

  /**
   * Checks whether the given message exists in the list
   *
   * @param  MessageInterface $message the message to search for
   * @return boolean true, if the message exists, false otherwise
   */
  public function contains(MessageInterface $message);
}
