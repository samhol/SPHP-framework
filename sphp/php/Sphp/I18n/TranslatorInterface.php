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
   * Returns a translated input message
   * 
   * @param  string $text the message text
   * @return string the message text translated
   */
  public function get(string $text): string;

  /**
   * Returns the input message array as analogous translated array
   * 
   * @param  array $messages input message array
   * @return array analogous translated array
   */
  public function translateArray(array $messages): array;

  /**
   * Returns the message as translated string
   *
   * @param  string $msgid1 the singular message being translated
   * @param  string $msgid2 the plural message being translated
   * @param  int $n the number of whatever determining the plurality
   * @return string the message text translated and parsed
   */
  public function getPlural(string $msgid1, string $msgid2, int $n): string;

  /**
   * Returns the the given message data as formatted localized string
   *
   * @param  string $message the message text
   * @param  array|null $args the arguments or null for no arguments
   * @param  boolean $translateArgs true for translated arguments and false otherwise
   * @return string the message text translated and parsed
   * @throws Sphp\Exceptions\InvalidArgumentException if invalid number of arguments is presented
   */
  public function vsprintf(string $message, array $args = null, bool $translateArgs = false): string;

  /**
   * Returns the the given message data as formatted localized string
   *
   * @param  string $msgid1 the singular message being translated
   * @param  string $msgid2 the plural message being translated
   * @param  int $n the number of whatever determining the plurality
   * @param  array|null $args the arguments or null for no arguments
   * @param  boolean $translateArgs true for translated arguments and false otherwise
   * @return string the message text translated and parsed
   * @throws Sphp\Exceptions\InvalidArgumentException if invalid number of arguments is presented
   */
  public function vsprintfPlural(string $msgid1, string $msgid2, int $n, array $args = null, bool $translateArgs = false): string;
}
