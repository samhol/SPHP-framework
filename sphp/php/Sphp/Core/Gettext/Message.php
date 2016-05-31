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
 * @version 2.2.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Message implements TranslatorChangerChainInterface {

  use TranslatorChangerChainTrait;

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
   * Constructs a new instance
   *
   * @param  string $message message text
   * @param  scalar[] $args arguments
   * @param  Translator|null $translator the translator component
   */
  public function __construct($message, array $args = [], Translator $translator = null) {
    $this->setMessage($message, $args);
    if ($translator !== null) {
      $this->setTranslator($translator);
    } else {
      $this->setTranslator(new Translator());
    }
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
    return $this->getTranslator()->vsprintf($this->message, $this->args);
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
