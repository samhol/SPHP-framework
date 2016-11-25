<?php

/**
 * TranslatorInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\I18n;

/**
 * Defines properties for natural language translator
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TranslatorInterface {

  public function getLang();

  /**
   * 
   * @param string $lang
   * @return self for PHP Method Chaining
   */
  public function setLang($lang);

  /**
   * Returns the input message(s) as translated message(s)
   * 
   * the the given array of message strings as an array of translated message strings
   *
   * @param  string|string[] $text the message text or an array of the message text
   * @return string|string[] the message text(s) translated
   * @uses   \dgettext() gettext function
   */
  public function get($text);

  /**
   * Returns the message as translated string
   *
   * @param  string $msgid1 the singular message being translated
   * @param  string $msgid2 the plural message being translated
   * @param  int $n the number of whatever determining the plurality
   * @return string the message text translated and parsed
   * @uses   \dngettext() dngettext function
   */
  public function getPlural($msgid1, $msgid2, $n);

  /**
   * Returns the the given message data as formatted localized string
   *
   * @param  string $message the message text
   * @param  null|mixed|mixed[] $args the arguments or null for no arguments
   * @param  boolean $translateArgs true for translated arguments and false otherwise
   * @return string the message text translated and parsed
   */
  public function vsprintf($message, $args = null, $translateArgs = false);

  /**
   * Returns the the given message data as formatted localized string
   *
   * @param  string $msgid1 the singular message being translated
   * @param  string $msgid2 the plural message being translated
   * @param  int $n the number of whatever determining the plurality
   * @param  null|mixed|mixed[] $args the arguments or null for no arguments
   * @param  boolean $translateArgs true for translated arguments and false otherwise
   * @return string the message text translated and parsed
   */
  public function vsprintfPlural($msgid1, $msgid2, $n, $args = null, $translateArgs = false);
}
