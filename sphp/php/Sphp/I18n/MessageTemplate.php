<?php

/**
 * MessageTemplate.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n;

use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Gettext\Translator;

/**
 * Implements a translatable message object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MessageTemplate {

  /**
   * original raw singular message
   *
   * @var string
   */
  private $singular;

  /**
   * original raw plural message
   *
   * @var string
   */
  private $plural;

  /**
   * the number (e.g. item count) to determine the translation for the respective grammatical number.
   *
   * @var int
   */
  private $n = 1;

  /**
   *
   * @var array
   */
  private $params = [];

  /**
   *
   * @var type 
   */
  private $translateArgs = false;

  /**
   *
   * @var TranslatorInterface 
   */
  private $translator;

  /**
   * Constructs a new instance
   *
   * @param TranslatorInterface $translator optional translator
   */
  public function __construct($singular = null, $plural = null,TranslatorInterface $translator = null) {
    $this->setSingular($singular)->setPlural($plural);
    if ($translator === null) {
      $translator = new Translator();
    }
    $this->setTranslator($translator);
  }

  public function getSingular() {
    return $this->singular;
  }

  public function getPlural() {
    return $this->plural;
  }

  public function isPlural() {
    return is_string($this->plural);
  }

  public function getN() {
    return $this->n;
  }

  public function getParams() {
    return $this->params;
  }

  public function hasParams() {
    return !empty($this->params);
  }

  public function setSingular($singular) {
    $this->singular = $singular;
    return $this;
  }

  public function setPlural($plural) {
    $this->plural = $plural;
    return $this;
  }

  public function setN($n) {
    $this->n = $n;
    return $this;
  }

  public function setParams($params) {
    $this->params = $params;
    return $this;
  }

  public function getTranslateArgs() {
    return $this->translateArgs;
  }

  public function setTranslateArgs($translateArgs) {
    $this->translateArgs = $translateArgs;
    return $this;
  }

  public function getTranslator() {
    return $this->translator;
  }

  public function setTranslator(TranslatorInterface $translator) {
    $this->translator = $translator;
    return $this;
  }

  /**
   * Returns a new message object
   *
   * @return MessageInterface new message object
   */
  public function generate() {

    if ($this->isPlural()) {
      $message = new PluralMessage($this->getSingular(), $this->getPlural(), $this->getN());
    } else {
      $message = new Message($this->getSingular());
    }
    $message->setTranslator($this->getTranslator())
            ->setTranslationRule($this->getTranslateArgs())
            ->setArguments($this->getParams());
    return $message;
  }

}
