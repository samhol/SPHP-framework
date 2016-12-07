<?php

/**
 * Translator.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\I18n\Gettext;

if (!defined('LC_MESSAGES')) {
  define('LC_MESSAGES', 6);
}

use Sphp\Core\Types\Arrays;
use Sphp\Core\I18n\AbstractTranslator;

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
   * @param string|null $domain the filename of the dictionary
   * @param string $directory the locale path of the dictionary
   * @param string $charset the character set of the dictionary
   */
  public function __construct($lang = 'en_US', $domain = \Sphp\DEFAULT_DOMAIN, $directory = \Sphp\LOCALE_PATH, $charset = 'utf8') {
    if ($domain === null) {
      throw new Exception('no domain');
    } else {
      DomainBinder::bindtextdomain($domain, $directory, $charset);
    }
    $this->domain = $domain;
    $this->directory = $directory;
    $this->charset = $charset;
    $this->lang = $lang;
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
   * @return string the name (filename) of the text domain
   */
  public function setDomain($domain) {
    $this->domain = $domain;
    DomainBinder::bindtextdomain($domain, $this->directory, $this->charset);
    return $this;
  }

  /**
   * {@inheritdoc}
   * @uses \dgettext() gettext function
   */
  public function get($text) {
    $parser = function($arg) {
      if (is_string($arg)) {
        return dgettext($this->getDomain(), $arg);
      }
      return $arg;
    };
    $tempLc = setLocale(\LC_MESSAGES, '0');
    //putenv("LC_ALL=$this->lang");  
    putenv("LC_ALL=$this->lang");
    //var_dump(getenv('LC_ALL'));
    setLocale(\LC_MESSAGES, $this->lang);
    //var_dump(setLocale(\LC_MESSAGES, '0'));
    //var_dump(setLocale(\LC_ALL, "0"));
    if (is_array($text)) {
      $translation = Arrays::multiMap($parser, $text);
    } else {
      $translation = dgettext($this->domain, $text);
    }
    setLocale(\LC_MESSAGES, $tempLc);
    return $translation;
  }

  /**
   * {@inheritdoc}
   * @uses   \dngettext() dngettext function
   */
  public function getPlural($msgid1, $msgid2, $n) {
    $tempLc = setLocale(\LC_MESSAGES, '0');
    putenv("LC_ALL=$this->lang");
    setLocale(\LC_MESSAGES, $this->lang);
    $translation = dngettext($this->domain, $msgid1, $msgid2, $n);
    setLocale(\LC_MESSAGES, $tempLc);
    return $translation;
  }

}
