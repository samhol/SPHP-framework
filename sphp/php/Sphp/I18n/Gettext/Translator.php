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
  public function __construct(string $domain = 'Sphp.Defaults', string $directory = 'sphp/locale', string $charset = 'utf8') {
    if ($domain === null) {
      throw new InvalidArgumentException('no domain');
    } else {
      DomainBinder::bindtextdomain($domain, $directory, $charset);
    }
    $this->domain = $domain;
    $this->directory = $directory;
    $this->charset = $charset;
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
   * Sets the name of the text domain
   *
   * @param  string $domain the name (filename) of the text domain
   * @return $this for a fluent interface
   */
  public function setDomain(string $domain) {
    $this->domain = $domain;
    DomainBinder::bindtextdomain($domain, $this->directory, $this->charset);
    return $this;
  }

  public function getDirectory() {
    return $this->directory;
  }

  public function getCharset() {
    return $this->charset;
  }

  public function setDirectory(string $directory = null) {
    $this->directory = $directory;
    return $this;
  }

  public function setCharset(string $charset = null) {
    $this->charset = $charset;
    return $this;
  }

  public function get($text, string $lang = null) {
    if ($lang === null) {
      $lang = $this->getLang();
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

  public function getPlural(string $msgid1, string $msgid2, int $n, string $lang = null): string {
    if ($lang === null) {
      $lang = $this->getLang();
    }
    $tempLc = setLocale(\LC_MESSAGES, '0');
    setLocale(\LC_MESSAGES, $lang);
    $translation = dngettext($this->domain, $msgid1, $msgid2, $n);
    setLocale(\LC_MESSAGES, $tempLc);
    return $translation;
  }

}
