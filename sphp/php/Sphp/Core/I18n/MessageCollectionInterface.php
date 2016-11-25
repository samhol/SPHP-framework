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
 * Class models a list that holds {@link Message} objects in a priority list
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
   * Checks whether the given {@link Message} exists in the list
   *
   * @param  Message $message the message to search for
   * @return boolean true, if the {@link Message} exists, false otherwise
   */
  public function exists(Message $message);

}
