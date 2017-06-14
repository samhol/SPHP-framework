<?php

/**
 * AbstractTemplate.php (UTF-8)
 * Copyright (c) 2010 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n\Messages;

use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Gettext\Translator;
use Sphp\I18n\Translators;

/**
 * Implements an abstract translatable message object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2010-09-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractTemplate implements TemplateInterface {

  /**
   * The translator object translating the messages
   *
   * @var Translator
   */
  private $translator;

  /**
   * Constructs a new instance
   *
   * @param  TranslatorInterface $translator the translator component
   */
  public function __construct(TranslatorInterface $translator = null) {
    if ($translator === null) {
      $translator = Translators::instance()->get();
    }
    $this->setTranslator($translator);
  }

  public function __destruct() {
    unset($this->translator);
  }

  public function __clone() {
    $this->translator = clone $this->translator;
  }

  public function __toString(): string {
    return $this->translate();
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
  public function getTranslator(): TranslatorInterface {
    return $this->translator;
  }

}
