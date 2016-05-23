<?php

/**
 * Translator.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Gettext;

use Sphp\Util\Arrays as Arrays;

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
 * @version 1.1.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Translator {

  /**
   * binded dictionary objects
   *
   * @var Translator[]
   */
  private static $dictionaries = [];

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
   * Constructs a new instance
   *
   * **IMPORTANT:**
   * The name of the `.mo` file must match the `$domain`. e.g the file path
   * (Finnish translations) should match `$directory/fi_FI/LC_MESSAGES/$domain.mo`
   *
   * @param string $domain the filename of the dictionary
   * @param string $directory the locale path of the dictionary
   * @param string $charset the character set of the dictionary
   */
  public function __construct($domain = \Sphp\DEFAULT_DOMAIN, $directory = \Sphp\LOCALE_PATH, $charset = "UTF-8") {
    if ($domain === null) {
      $this->domain = Locale::getCurrentTextDomain();
    } else {
      $this->domain = $domain;
    }
    $this->directory = $directory;
    $this->charset = $charset;

    /* $hashId = hash("md4", $directory . $charset . $domain);
      if (!in_array($hashId, self::$dictionaries)) {
      bindtextdomain($this->domain, $directory);
      bind_textdomain_codeset($this->domain, $charset);
      self::$dictionaries[] = $hashId;
      } */
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
   * **IMPORTANT:** If the optional `$lang` is not set the translation is done
   *  using the current system locale
   *
   * @param  string|string[] $text the message text
   * @param  string|null $lang optional translation language
   * @return string|string[] the message text(s) translated
   * @uses   \dgettext() gettext function
   */
  public function get($text, $lang = null) {
    if ($lang !== null) {
      $defaultLocale = Locale::getMessageLocale();
      Locale::setMessageLocale($lang);
    }
    if (is_array($text)) {
      $translation = $this->getArray($text);
    } else {
      $translation = dgettext($this->getDomain(), $text);
    }
    if ($lang !== null) {
      Locale::setMessageLocale($defaultLocale);
    }
    return $translation;
  }

  /**
   * Returns the message as translated string
   *
   * **IMPORTANT:** If the optional `$lang` is not set the translation is done
   *  using the current system locale
   *
   * @param  string $msgid1 the singular message being translated
   * @param  string $msgid2 the plural message being translated
   * @param  int $n the number of whatever determining the plurality
   * @param  string|null $lang optional the locale information (translation language).
   * @return string the message text translated and parsed
   * @uses   \dngettext() dngettext function
   */
  public function getPlural($msgid1, $msgid2, $n, $lang = null) {
    if ($lang !== null) {
      $defaultLocale = Locale::getMessageLocale();
      Locale::setMessageLocale($lang);
    }
    $translation = dngettext($this->getDomain(), $msgid1, $msgid2, $n);
    if ($lang !== null) {
      Locale::setMessageLocale($defaultLocale);
    }
    return $translation;
  }

  /**
   * Returns the the given message data as formatted localized string
   *
   * @param  string $message the message text
   * @param  scalar[] $args the arguments
   * @return string the message text translated and parsed
   */
  public function vsprintf($message, array $args = []) {
    $parser = function($arg) {
      if (is_string($arg)) {
        return $this->get($arg);
      }
      return $arg;
    };
    $m = $this->get($message);
    if (count($args) > 0) {
      $args = array_map($parser, $args);
      $m = vsprintf($m, $args);
    }
    return $m;
  }

  /**
   * Returns the the given message data as formatted localized string
   *
   * @param  string $msgid1 the singular message being translated
   * @param  string $msgid2 the plural message being translated
   * @param  int $n the number of whatever determining the plurality
   * @param  scalar[] $args the arguments
   * @return string the message text translated and parsed
   */
  public function vsprintfPlural($msgid1, $msgid2, $n, array $args = []) {
    $parser = function($arg) {
      if (is_string($arg)) {
        return $this->get($arg);
      }
      return $arg;
    };
    $m = $this->getPlural($msgid1, $msgid2, $n);
    if (count($args) > 0) {
      $args = array_map($parser, $args);
      $m = vsprintf($m, $args);
    }
    return $m;
  }

  /**
   * Returns the the given array of message strings as an array of translated message strings
   *
   * @param  string[] $messages the messages
   * @return string[] translated messages
   */
  public function getArray(array $messages = []) {
    $parser = function($arg) {
      if (is_string($arg)) {
        return $this->get($arg);
      }
      return $arg;
    };
    $result = [];
    if (count($messages) > 0) {
      $result = Arrays::multiMap($parser, $messages);
    }
    return $result;
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
   * @return Translator the default translator of the system
   */
  public static function defaultTranslator() {
    return new Translator(null);
  }

}
