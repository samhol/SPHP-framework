<?php

/**
 * PluralMessage.php (UTF-8)
 * Copyright (c) 2010 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

use Sphp\Core\I18n\TranslatorInterface;
use Sphp\Core\I18n\Gettext\Translator;

/**
 * Implements a translatable message object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2010-09-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractMessage implements MessageInterface {

  use TranslatorAwareTrait;

  /**
   * original raw message arguments
   *
   * @var scalar[]
   */
  private $args;
  private $translateArgs = false;

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
  }

  /**
   * 
   * @param  null|mixed|mixed[] $args the arguments or null for no arguments
   * @param type $translateArgs
   * @return $this
   */
  public function setArguments($args, $translateArgs = false) {
    $this->args = $args;
    $this->translateArgs = $translateArgs;
    return $this;
  }

  /**
   * 
   * @param  null|mixed|mixed[] $args the arguments or null for no arguments
   */
  public function getArguments() {
    if ($this->args !== null && $this->translateArgs) {
      return $this->getTranslator()->get($this->args);
    } else {
      return $this->args;
    }
  }

  public function translateArguments($translateArgs = false) {
    $this->translateArgs = $translateArgs;
    return $this;
  }

  /**
   * 
   * @return TranslatorInterface
   */
  public function getTranslator() {
    return $this->translator;
  }

  public function __toString() {
    return $this->translate();
  }

  /**
   * Returns the message as a formatted and localized json string
   *
   * @return string the object as a formatted and localized json string
   */
  public function toJson() {
    return '"' . $this . '"';
  }

}
