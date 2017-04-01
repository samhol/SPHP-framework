<?php

/**
 * MessageInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n;

/**
 * Defines properties for a translatable message object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface MessageInterface extends TranslatorAwareInterface {

  /**
   * Returns the message as formatted and translated string
   *
   * @return string the message as formatted and translated string
   */
  public function translate();

  /**
   * Returns the message object as a string
   *
   * @return string the message object as a string
   */
  public function __toString();
}
