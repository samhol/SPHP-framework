<?php

/**
 * AbstractMessage.php (UTF-8)
 * Copyright (c) 2010 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n;

use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Gettext\Translator;
use Sphp\Stdlib\BitMask;
use Sphp\Config\Locale;

/**
 * Implements an abstract translatable message object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2010-09-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractMessage implements MessageInterface {

  /**
   *
   */
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
   * The translator object translating the messages
   *
   * @var Translator
   */
  private $translator;

  /**
   *
   * @var string
   */
  private $lang;

  /**
   *
   * @var BitMask
   */
  private $translationRule;

  /**
   * Constructs a new instance
   *
   * @param  null|mixed|mixed[] $args optional arguments or null for no arguments
   * @param  TranslatorInterface|null $translator the translator component
   */
  public function __construct($args = null, $rule = self::TRANSLATE_MESSAGE, TranslatorInterface $translator = null) {
    $this->setTranslationRule($rule);
    $this->setArguments($args);
    if ($translator !== null) {
      $this->setTranslator($translator);
    }
    $this->lang = null;
  }

  public function __destruct() {
    unset($this->translator, $this->args);
  }

  public function __clone() {
    if ($this->translator !== null) {
      $this->translator = clone $this->translator;
    }
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
    return !empty($this->args);
  }

  /**
   *
   * @return null|array $args the arguments or null for no arguments
   */
  public function getArguments() {
    if ($this->hasArguments() && $this->translatesArguments()) {
      return $this->getTranslator()->get($this->args, $this->getLang());
    } else {
      return $this->args;
    }
  }

  /**
   *
   * @return BitMask
   */
  public function getTranslationRule() {
    return $this->translationRule;
  }

  /**
   *
   * @param  int|BitMask $translationRule
   * @return self for a fluent interface
   */
  public function setTranslationRule($translationRule) {
    if (!$translationRule instanceof BitMask) {
      $translationRule = new BitMask($translationRule);
    }
    $this->translationRule = $translationRule;
    return $this;
  }

  /**
   *
   * @return boolean
   */
  public function translates() {
    return $this->translator !== null && !$this->translationRule->equals(static::NO_TRANSLATION);
  }

  /**
   *
   * @return boolean
   */
  public function translatesMessage() {
    return $this->translator !== null && $this->translationRule->contains(static::TRANSLATE_MESSAGE);
  }

  /**
   *
   * @return boolean
   */
  public function translatesArguments() {
    return $this->translator !== null && $this->translationRule->contains(static::TRANSLATE_ARGS);
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
   * @return TranslatorInterface|null the translator component or `NULL` if no translator is defined
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
    $this->lang = $lang;
    return $this;
  }

  /**
   * Gets the translator component for message translation
   *
   * @return string the translator language
   */
  public function getLang() {
    if ($this->usesSystemLanguage()) {
      return Locale::getMessageLocale();
    }
    return $this->lang;
  }

  /**
   *
   * @return boolean
   */
  public function usesSystemLanguage() {
    return !is_string($this->lang);
  }

  /**
   *
   * @return string message without formatting
   */
  abstract public function getMessage();

  /**
   * Returns the message as formatted and translated string
   *
   * @return string the message as formatted and translated string
   */
  public function translate() {
    $message = $this->getMessage();
    if ($this->hasArguments()) {
      $message = vsprintf($message, $this->getArguments());
      if ($message === false) {
        throw new \Sphp\Exceptions\RuntimeException();
      }
    }
    return $message;
  }

}
