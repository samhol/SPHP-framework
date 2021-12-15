<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n;

use Sphp\I18n\Exceptions\TranslatorException;

/**
 * Defines properties for natural language translator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Translator {

  /**
   * Returns the locale parameters used for translations
   * 
   * @return string[] locale parameters to try 
   */
  public function getLocale(): array;

  /**
   * Checks whether the translator has build-in locale parameters
   * 
   * @return bool true if parameters exists
   */
  public function hasLocales(): bool;

  /**
   * Sets the locale parameters used for translations
   * 
   * @param string ... $locale parameters to try as locale settings until success
   * @return $this for a fluent interface
   */
  public function setLocale(string ... $locale);

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
   * @param  string[] $messages input message array
   * @return string[] analogous translated array
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
   * @param  array $args the arguments or null for no arguments
   * @param  bool $translateArgs true for translated arguments and false otherwise
   * @return string the message text translated and parsed
   * @throws TranslatorException if invalid number of arguments is presented
   */
  public function vsprintf(string $message, array $args, bool $translateArgs = false): string;

  /**
   * Returns the the given message data as formatted localized string
   *
   * @param  string $msgid1 the singular message being translated
   * @param  string $msgid2 the plural message being translated
   * @param  int $n the number of whatever determining the plurality
   * @param  array $args the arguments or null for no arguments
   * @param  bool $translateArgs true for translated arguments and false otherwise
   * @return string the message text translated and parsed
   * @throws TranslatorException if invalid number of arguments is presented
   */
  public function vsprintfPlural(string $msgid1, string $msgid2, int $n, array $args, bool $translateArgs = false): string;
}
