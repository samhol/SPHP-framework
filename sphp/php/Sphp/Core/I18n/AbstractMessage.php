<?php

/**
 * AbstractMessage.php (UTF-8)
 * Copyright (c) 2010 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

use Sphp\Core\I18n\TranslatorInterface;
use Sphp\Core\I18n\Gettext\Translator;

/**
 * Implements an abstract translatable message object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2010-09-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractMessage implements MessageInterface {

  const NO_TRANSLATION = 0b0;
  const TRANSLATE_MESSAGE = 0b1;
  const TRANSLATE_ARGS = 0b10;
  const TRANSLATE_ALL = 0b11;

  /**
   * original raw message arguments
   *
   * @var scalar[]
   */
  private $args;

  /**
   *
   * @var boolean
   */
  private $translateArgs = false;

  /**
   * The translator object translating the messages
   *
   * @var Translator
   */
  private $translator;
  
  private $lang;

  /**
   * Constructs a new instance
   *
   * @param  null|mixed|mixed[] $args the arguments or null for no arguments
   * @param  TranslatorInterface|null $translator the translator component
   */
  public function __construct($args = null, $translateArgs = false, TranslatorInterface $translator = null) {
    $this->setArguments($args, $translateArgs);
    if ($translator === null) {
      $translator = new Translator();
    }
    $this->setTranslator($translator);
    $this->lang = null;
  }

  public function __clone() {
    ;
  }

  public function __toString() {
    return $this->translate();
  }

  /**
   * 
   * @param  null|mixed|mixed[] $args the arguments or null for no arguments  
   * @return self for a fluent interface
   */
  public function setArguments($args) {
    $this->args = $args;
    return $this;
  }
  /**
   * 
   * @return boolean
   */
  public function hasArguments() {
    if (is_array($this->args)) {   
      return !empty($this->args);
    } else {
     return $this->args !== null;
    }
  }
  /**
   * 
   * @return null|mixed|mixed[] $args the arguments or null for no arguments
   */
  public function getArguments($translated = false) {
    if ($this->args !== null && $translated) {
      return $this->getTranslator()->get($this->args, $this->lang);
    } else {
      return $this->args;
    }
  }

  /**
   * 
   * @param  boolean $translateArgs  
   * @return self for a fluent interface
   */
  public function setArgumentTranslation($translateArgs = false) {
    $this->translateArgs = $translateArgs;
    return $this;
  }

  /**
   * 
   * @return boolean
   */
  public function translateArguments() {
    return $this->translateArgs;
  }

  /**
   * Sets the translator component for message translation
   *
   * @param  TranslatorInterface $translator the translator component
   * @return self for a fluent interface
   */
  public function setTranslator(TranslatorInterface $translator) {
    $this->translator = $translator;
    return $this;
  }

  /**
   * Returns the translator component used for message translation
   *
   * @return TranslatorInterface the translator component
   */
  public function getTranslator() {
    if ($this->translator === null) {
      $this->setTranslator(new Translator());
    }
    return $this->translator;
  }

  /**
   * 
   * @return boolean
   */
  public function hasTranslator() {
    return $this->translator !== null;
  }

  /**
   * Sets the translator component for message translation
   *
   * @param  string $lang the translator language
   * @return self for a fluent interface
   */
  public function setLang($lang) {
    $this->lang  = $lang;
    return $this;
  }

  /**
   * Sets the translator component for message translation
   *
   * @return string|null the translator language
   */
  protected function getLang() {
    return $this->lang;
  }

}
