<?php

/**
 * Translator.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\I18n\Zend;

use Sphp\Core\I18n\AbstractTranslator;
use Sphp\Core\Types\Arrays;
use Zend\I18n\Translator\Translator as ZendTranslator;
use ReflectionClass;
use Exception;

/**
 * Implements a natural language translator
 *
 * The underlying technology used in translation is Zend's translator class
 *
 * @method self toAscii(string $str, bool $removeUnsupported = true)
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @link    https://zendframework.github.io/zend-i18n/translation/
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
   *
   * @var ZendTranslator 
   */
  private $translator;

  /**
   *
   * @var ReflectionClass 
   */
  private $reflector;

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
  public function __construct($lang = null, ZendTranslator $t = null) {
    if ($t === null) {
      $t = new ZendTranslator();
    }
    $this->translator = $t;
    $this->lang = $lang;
    $this->reflector = new ReflectionClass($this->translator);
  }

  /**
   * 
   * @param string $name
   * @param mixed[] $arguments
   * @return \Sphp\Core\I18n\Zend\Translator
   * @throws BadMethodCallException
   */
  public function __call($name, array $arguments = []) {
    try {
      $result = $this->reflector->getMethod($name)->invokeArgs($this->translator, $arguments);
    } catch (Exception $ex) {
      throw new BadMethodCallException($name . ' is not a valid method', 0, $ex);
    }
    if ($result !== null && $result !== $this->translator) {
      return $result;
    } else {
      return $this;
    }
  }

  public function addTranslationFilePattern($type, $baseDir, $pattern, $textDomain) {
    $this->translator->addTranslationFilePattern($type, $baseDir, $pattern, $textDomain);
    return $this;
  }

  public function getLang() {
    return $this->translator->getLocale();
  }

  /**
   * 
   * @param string $lang
   * @return self for PHP Method Chaining
   */
  public function setLang($lang) {
    $this->translator->setLocale($lang);
    return $this;
  }

  /**
   * Returns the name of the text domain
   *
   * @return string the name (filename) of the text domain
   */
  public function setUsedDomain($domain) {
    $this->domain = $domain;
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

  public function get($text) {
    $parser = function($arg) {
      if (is_string($arg)) {
        return $this->translator->translate($arg, $this->getDomain(), $this->getLang());
      }
      return $arg;
    };
    if (is_array($text)) {
      $translation = Arrays::multiMap($parser, $text);
    } else {
      $translation = $this->translator->translate($text, $this->getDomain(), $this->getLang());
    }
    return $translation;
  }

  public function getPlural($msgid1, $msgid2, $n) {
    return $this->translator->translatePlural($msgid1, $msgid2, $n, $this->getDomain(), $this->getLang());
  }

  public static function FromTranslationFilePattern($lang, $directory, $domain) {
    $t = new ZendTranslator();
    $t->addTranslationFilePattern('gettext', \Sphp\LOCALE_PATH, $directory, $domain);
    return new static($lang, $t);
  }

}
