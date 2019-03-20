<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n\Zend;

use Sphp\I18n\AbstractTranslator;
use Zend\I18n\Translator\Translator as ZendTranslator;
use ReflectionClass;
use Exception;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Implements a natural language translator
 *
 * The underlying technology used in translation is Zend's translator class
 *
 * @method self toAscii(string $str, bool $removeUnsupported = true)
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://zendframework.github.io/zend-i18n/translation/
 * @license https://opensource.org/licenses/MIT The MIT License
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
   * @var ZendTranslator 
   */
  private $translator;

  /**
   *
   * @var ReflectionClass 
   */
  private $reflector;

  /**
   * Constructor
   *
   * @param ZendTranslator|null $t
   */
  public function __construct(ZendTranslator $t = null) {
    if ($t === null) {
      $t = new ZendTranslator();
    }
    $this->translator = $t;
    //$this->setLang($lang);
    $this->reflector = new ReflectionClass($this->translator);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->translator, $this->reflector);
  }

  /**
   * 
   * @param string $name
   * @param mixed[] $arguments
   * @return mixed
   * @throws BadMethodCallException
   */
  public function __call(string $name, array $arguments = []) {
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

  /**
   * 
   * @param type $type
   * @param type $baseDir
   * @param type $pattern
   * @param type $textDomain
   * @return $this for a fluent interface
   */
  public function addTranslationFilePattern($type, $baseDir, $pattern, $textDomain) {
    $this->translator->addTranslationFilePattern($type, $baseDir, $pattern, $textDomain);
    return $this;
  }

  /**
   * Returns the ZEND translator used
   * 
   * @return ZendTranslator the ZEND translator used
   */
  public function getZend(): ZendTranslator {
    return $this->translator;
  }

  public function getLang(): string {
    return $this->getZend()->getLocale();
  }

  public function setLang(string $lang = null) {
    $this->getZend()->setLocale($lang);
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

  public function get(string $text): string {
    return $this->getZend()->translate($text, $this->getDomain(), $this->getLang());
  }

  public function getPlural(string $msgid1, string $msgid2, int $n): string {
    return $this->getZend()->translatePlural($msgid1, $msgid2, $n, $this->getDomain(), $this->getLang());
  }

  /**
   * 
   * @param  string $type
   * @param  string $baseDir
   * @param  string $pattern
   * @param  string $textDomain
   * @return Translator
   */
  public static function fromFilePattern(string $type, string $baseDir, string $pattern, string $textDomain = 'default'): Translator {
    $t = new ZendTranslator();
    $t->addTranslationFilePattern($type, $baseDir, $pattern, $textDomain);
    return new static($t);
  }

}
