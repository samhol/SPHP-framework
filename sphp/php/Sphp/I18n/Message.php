<?php

/**
 * Message.php (UTF-8)
 * Copyright (c) 2010 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n;

use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Gettext\Translator;

/**
 * Implements a translatable message object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2010-09-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Message extends AbstractMessage {

  /**
   * original raw message
   *
   * @var string
   */
  private $message;

  /**
   * Constructs a new instance
   *
   * @param string $message
   * @param null|mixed|mixed[] $args optional arguments
   * @param int $rules
   * @param TranslatorInterface $translator optional translator
   */
  public function __construct($message, $args = null, TranslatorInterface $translator = null, $rules = self::TRANSLATE_MESSAGE) {
    parent::__construct($args, $rules, $translator);
    $this->message = $message;
    if ($translator !== null) {
      $this->setTranslator($translator);
    }
  }

  /**
   * 
   * @return string message
   */
  public function getMessage() {
    if ($this->translatesMessage()) {
      return $this->getTranslator()->get($this->message, $this->getLang());
    } else {
      return $this->message;
    }
  }

  /**
   * Returns the message as formatted and translated string
   *
   * @return string the message as formatted and translated string
   */
  public function translate() {
    $message = $this->getMessage();
    if ($this->hasArguments()) {
      $message = vsprintf($message, $this->getArguments());
    }
    return $message;
  }

}
