<?php

/**
 * Translator.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\I18n\Gettext;

if (!defined('LC_MESSAGES')) {
  define('LC_MESSAGES', 6);
}

use Sphp\I18n\AbstractTranslator;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Arrays;
use Sphp\Config\Locale;

/**
 * Implements a natural language translator
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
class Translator extends AbstractTranslator {

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
   * @param  string|null $lang optional language used (defaults to system locale)
   * @param  string|null $domain the filename of the dictionary
   * @param  string $directory the locale path of the dictionary
   * @param  string $charset the character set of the dictionary
   * @throws InvalidArgumentException
   */
  public function __construct($domain = 'Sphp.Defaults', $directory = 'sphp/locale', $charset = 'utf8') {
    if ($domain === null) {
      throw new InvalidArgumentException('no domain');
    } else {
      DomainBinder::bindtextdomain($domain, $directory, $charset);
    }
    $this->domain = $domain;
    $this->directory = $directory;
    $this->charset = $charset;
  }

  public function getLang() {
    return $this->lang;
  }

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
   * Returns the name of the text domain
   *
   * @param string the name (filename) of the text domain
   * @return self for a fluent interface
   */
  public function setDomain($domain) {
    $this->domain = $domain;
    DomainBinder::bindtextdomain($domain, $this->directory, $this->charset);
    return $this;
  }

  public function get($text, $lang = null) {
    if ($lang === null) {
      $lang = $this->lang;
    }
    $parser = function($arg) {
      if (is_string($arg)) {
        return dgettext($this->getDomain(), $arg);
      }
      return $arg;
    };
    $tempLc = setLocale(\LC_MESSAGES, '0');
    setLocale(\LC_MESSAGES, $lang);
    if (is_array($text)) {
      $translation = Arrays::multiMap($parser, $text);
    } else {
      $translation = dgettext($this->domain, $text);
    }
    setLocale(\LC_MESSAGES, $tempLc);
    return $translation;
  }

  public function getPlural($msgid1, $msgid2, $n, $lang = null) {
    if ($lang === null) {
      $lang = $this->lang;
    }
    $tempLc = setLocale(\LC_MESSAGES, '0');
    setLocale(\LC_MESSAGES, $lang);
    $translation = dngettext($this->domain, $msgid1, $msgid2, $n);
    setLocale(\LC_MESSAGES, $tempLc);
    return $translation;
  }

}
