<?php

/**
 * Message.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\Gettext;

/**
 * Class defines an message object for a HTML-form element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2010-09-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Message implements LanguageChangerChainInterface {

  use LanguageChangerChainTrait;

  /**
   * original raw message
   *
   * @var string
   */
  private $message;

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
   * Constructs a new instance
   *
   * @param  string $message message text
   * @param  scalar[] $args arguments
   * @param  Translator|null $translator the translator component
   */
  public function __construct($message, array $args = [], Translator $translator = null) {
    $this->setMessage($message, $args);
    if ($translator === null) {
      $translator = new Translator();
    }
    $this->translator = $translator;
  }
  
  public function getTranslator() {
    return $this->translator;
  }

  /**
   * 
   * @param string $lang
   * @return self for PHP Method Chaining
   */
  public function setLang($lang) {
    $this->translator->setLang($lang);
    return $this;
  }

  /**
   * Sets the message text
   *
   * @param  string $message the message text
   * @param  scalar[] $args arguments
   * @return self for PHP Method Chaining
   */
  private function setMessage($message, array $args = []) {
    $this->message = $message;
    $this->args = $args;
    return $this;
  }

  /**
   * Returns the message as formatted and translated string
   *
   * @return string the message as formatted and translated string
   */
  public function parseMessage() {
    return $this->translator->vsprintf($this->message, $this->args);
  }

  /**
   * Returns the object as a string
   *
   * @return string the object as a string
   */
  public function __toString() {
    return $this->parseMessage();
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
