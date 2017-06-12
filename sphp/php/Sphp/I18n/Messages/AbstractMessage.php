<?php

/**
 * AbstractMessage.php (UTF-8)
 * Copyright (c) 2010 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n\Messages;

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
   * TemplateInterface
   *
   * @var TemplateInterface
   */
  private $template;

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
   * @var bool
   */
  private $translationRule;

  /**
   * Constructs a new instance
   *
   * @param  null|mixed|mixed[] $args optional arguments or null for no arguments
   * @param  TranslatorInterface|null $translator the translator component
   */
  public function __construct(TemplateInterface $template, array $args = [], TranslatorInterface $translator = null) {
    $this->template = $template;
    $this->setArguments($args);
    if ($translator !== null) {
      $this->setTranslator($translator);
    }
    $this->translationRule = false;
  }

  public function __destruct() {
    unset($this->translator, $this->args);
  }

  public function __clone() {
    if ($this->translator !== null) {
      $this->translator = clone $this->translator;
    }
  }

  public function __toString(): string {
    try {
      return $this->translate();
    } catch (\Throwable $ex) {
      return "$ex";
    }
  }

  public function getTemplate(): TemplateInterface {
    return $this->template;
  }

  /**
   *
   * @param  null|mixed|mixed[] $args the arguments or null for no arguments
   * @return self for a fluent interface
   */
  public function setArguments(array $args) {
    $this->args = $args;
    return $this;
  }

  /**
   *
   * @return boolean
   */
  public function hasArguments(): bool {
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
   * @param  bool $translateArguments
   * @return self for a fluent interface
   */
  public function translateArguments($translateArguments = true) {
    $this->translationRule = $translateArguments;
    return $this;
  }


  /**
   *
   * @return boolean
   */
  public function translatesArguments(): bool {
    return $this->translationRule;
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
    return $this->template->getTranslator();
  }

  /**
   * Returns the message as formatted and translated string
   *
   * @return string the message as formatted and translated string
   */
  public function translate(): string {
    $message = $this->template->translate();
    if ($this->hasArguments()) {
      $message = vsprintf($message, $this->getArguments());
      if ($message === false) {
        throw new \Sphp\Exceptions\RuntimeException("Wrong number of parameters");
      }
    }
    return $message;
  }

}
