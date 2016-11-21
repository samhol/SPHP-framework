<?php

/**
 * Translator.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Gettext;

if (!defined('LC_MESSAGES')) {
  define('LC_MESSAGES', 6);
}

use Sphp\Core\Types\Arrays;

/**
 * A class for natural language translations
 *
 * The underlying technology used in translation is PHP's gettext extension.
 *
 * **Links:**
 *
 * * {@link http://www.gnu.org/software/gettext/manual/}
 * * {@link http://www.gnu.org/software/gettext/manual/html_node/index.html}
 * * {@link http://php.net/manual/en/book.gettext.php}
 * * {@link http://php.net/manual/en/function.setlocale.php}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Translator {

  /**
   * the name (filename) of the used text domain
   *
   * @var string
   */
  private $domain;

  /**
   * the path of the translation file
   *
   * @var string
   */
  private $directory;

  /**
   * the charset of the translation file
   *
   * @var string
   */
  private $charset;

  /**
   * the charset of the translation file
   *
   * @var string
   */
  private $lang;

  /**
   * Constructs a new instance
   *
   * **IMPORTANT:**
   * The name of the `.mo` file must match the `$domain`. e.g the file path
   * (Finnish translations) should match `$directory/fi_FI/LC_MESSAGES/$domain.mo`
   *
   * @param string|null $domain the filename of the dictionary
   * @param string $directory the locale path of the dictionary
   * @param string $charset the character set of the dictionary
   */
  public function __construct($lang = 'en_US', $domain = \Sphp\DEFAULT_DOMAIN, $directory = \Sphp\LOCALE_PATH, $charset = 'UTF-8') {
    if ($domain === null) {
      throw new Exception('no domain');
    } else {
      $this->domain = $domain;
    }
    $this->directory = $directory;
    $this->charset = $charset;
    $this->lang = $lang;
  }

  public function getLang() {
    return $this->lang;
  }

  /**
   * 
   * @param string $lang
   * @return self for PHP Method Chaining
   */
  public function setLang($lang) {
    $this->lang = $lang;
    return $this;
  }

  /**
   * Returns the name of the text domain
   *
   * @return string the name (filename) of the text domain
   */
  public function getDomain() {
    return $this->domain;
  }

  /**
   * Returns the directory path
   *
   * @return string the directory containing the dictionaries
   */
  public function getDirectory() {
    return $this->directory;
  }

  /**
   * Returns the character encoding of the dictionary
   *
   * @return string the character encoding of the dictionary
   */
  public function getCharset() {
    return $this->charset;
  }

  /**
   * Returns the input message(s) as translated message(s)
   * 
   * the the given array of message strings as an array of translated message strings
   *
   * @param  string|string[] $text the message text or an array of the message text
   * @return string|string[] the message text(s) translated
   * @uses   \dgettext() gettext function
   */
  public function get($text) {
    $parser = function($arg) {
      if (is_string($arg)) {
        return dgettext($this->getDomain(), $arg);
      }
      return $arg;
    };
    $tempLc = setLocale(\LC_MESSAGES, '0');
    putenv("LC_ALL=$this->lang");
    setLocale(\LC_MESSAGES, $this->lang);
    if (is_array($text)) {
      $translation = Arrays::multiMap($parser, $text);
    } else {
      $translation = dgettext($this->getDomain(), $text);
    }
    setLocale(\LC_MESSAGES, $tempLc);
    return $translation;
  }

  /**
   * Returns the message as translated string
   *
   * @param  string $msgid1 the singular message being translated
   * @param  string $msgid2 the plural message being translated
   * @param  int $n the number of whatever determining the plurality
   * @return string the message text translated and parsed
   * @uses   \dngettext() dngettext function
   */
  public function getPlural($msgid1, $msgid2, $n) {
    $tempLc = setLocale(LC_MESSAGES, '0');
    setLocale(LC_MESSAGES, $this->lang);
    $translation = dngettext($this->getDomain(), $msgid1, $msgid2, $n);
    setLocale(LC_MESSAGES, $tempLc);
    return $translation;
  }

  /**
   * Returns the the given message data as formatted localized string
   *
   * @param  string $message the message text
   * @param  null|mixed|mixed[] $args the arguments
   * @return string the message text translated and parsed
   */
  public function vsprintf($message, $args = null) {
    $m = $this->get($message);
    if ($args !== null) {
      $args = $this->get($args);
      $m = vsprintf($m, is_array($args) ? $args : [$args]);
    }
    return $m;
  }

  /**
   * Returns the the given message data as formatted localized string
   *
   * @param  string $msgid1 the singular message being translated
   * @param  string $msgid2 the plural message being translated
   * @param  int $n the number of whatever determining the plurality
   * @param  null|mixed|mixed[] $args the arguments
   * @return string the message text translated and parsed
   */
  public function vsprintfPlural($msgid1, $msgid2, $n, $args = null) {
    $m = $this->getPlural($msgid1, $msgid2, $n);
    if ($args !== null) {
      $args = $this->get($args);
      $m = vsprintf($m, is_array($args) ? $args : [$args]);
    }
    return $m;
  }

  /**
   * Executes the dictionary for the given value
   *
   * @param  mixed $text the value to filter
   * @return mixed the filtered value
   */
  public function __invoke($text) {
    $numArgs = func_num_args();
    $args = func_get_args();
    if ($numArgs === 1) {
      return $this->get($text);
    } else if ($numArgs === 2) {

      if (is_string($args[1])) {
        return $this->get($text, $args[1]);
      }
    } else if ($numArgs >= 3) {

      if (is_string($args[1]) && is_int($args[2])) {
        return $this->getPlural($text, $args[1], $args[1]);
      }
    }
    return $this->filter($text);
  }

  /**
   * Returns the default translator of the system
   *
   * @return self the default translator of the system
   */
  public static function defaultTranslator() {
    return new static(null);
  }

}
