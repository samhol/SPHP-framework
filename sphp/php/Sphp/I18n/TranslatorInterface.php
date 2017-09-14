<?php

/**
 * TranslatorInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\I18n;

/**
 * Defines properties for natural language translator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TranslatorInterface {

  /**
   * Returns the language used for translations
   * 
   * @return string the name of the language used for translations
   */
  public function getLang(): string;

  /**
   * Sets the language used for translations
   * 
   * @param string $lang the name of the language used for translations
   * @return $this for a fluent interface
   */
  public function setLang(string $lang);

  /**
   * Returns the input message(s) as translated message(s)
   * 
   * the the given array of message strings as an array of translated message strings
   *
   * @param  string $text the message text or an array of the message text
   * @return string the message text(s) translated
   */
  public function get(string $text): string;
  public function translateArray(array $messages): array;

  /**
   * Returns the message as translated string
   *
   * @param  string $msgid1 the singular message being translated
   * @param  string $msgid2 the plural message being translated
   * @param  int $n the number of whatever determining the plurality
   * @param  string $lang
   * @return string the message text translated and parsed
   */
  public function getPlural(string $msgid1, string $msgid2, int $n): string;

  /**
   * Returns the the given message data as formatted localized string
   *
   * @param  string $message the message text
   * @param  null|mixed|mixed[] $args the arguments or null for no arguments
   * @param  boolean $translateArgs true for translated arguments and false otherwise
   * @return string the message text translated and parsed
   */
  public function vsprintf(string $message, $args = null, bool $translateArgs = false): string;

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
  public function vsprintfPlural(string $msgid1, string $msgid2, int $n, $args = null, bool $translateArgs = false): string;
}
