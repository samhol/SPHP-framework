<?php

/**
 * AbstractMessage.php (UTF-8)
 * Copyright (c) 2010 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n\Messages;

use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Gettext\Translator;

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
   * message template
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
   * @var TranslatorInterface
   */
  private $translator;

  /**
   * @var bool
   */
  private $translateArgs;

  /**
   * Constructs a new instance
   *
   * @param  array $args optional arguments or null for no arguments
   * @param  TranslatorInterface|null $translator the translator component
   */
  public function __construct(TemplateInterface $template, array $args = [], TranslatorInterface $translator = null) {
    $this->template = $template;
    $this->setArguments($args);
    if ($translator !== null) {
      $this->setTranslator($translator);
    }
    $this->translateArgs = false;
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

  public function setArguments(array $args) {
    $this->args = $args;
    return $this;
  }

  public function hasArguments(): bool {
    return !empty($this->args);
  }

  public function getArguments() {
    if (!empty($this->args) && $this->translateArgs) {
      return $this->getTranslator()->get($this->args, $this->getLang());
    } else {
      return $this->args;
    }
  }

  public function translateArguments(bool $translateArguments = true) {
    $this->translateArgs = $translateArguments;
    return $this;
  }

  public function translatesArguments(): bool {
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
   * @return TranslatorInterface|null the translator component or `NULL` if no translator is defined
   */
  public function getTranslator(): TranslatorInterface {
    if ($this->translator === null) {
      return $this->template->getTranslator();
    }
    return $this->translator;
  }

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

  public function translateTo(string $lang): string {
    $message = $this->template->translateTo($lang);
    if ($this->hasArguments()) {
      $message = vsprintf($message, $this->getArguments());
      if ($message === false) {
        throw new \Sphp\Exceptions\RuntimeException("Wrong number of parameters");
      }
    }
    return $message;
  }

}
