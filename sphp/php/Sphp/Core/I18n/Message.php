<?php

/**
 * Message.php (UTF-8)
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
   * @param boolean $translateArgs
   * @param TranslatorInterface $translator optional translator
   */
  public function __construct($message, $args = null, $translateArgs = false, TranslatorInterface $translator = null) {
    parent::__construct($args, $translateArgs, $translator);
    $this->message = $message;
    if ($translator === null) {
      $translator = new Translator();
    }
    $this->setTranslator($translator);
  }

  /**
   * Returns the message as formatted and translated string
   *
   * @return string the message as formatted and translated string
   */
  public function translate() {
    $message = $this->getTranslator()->get($this->message, $this->getLang());
    if ($this->hasArguments()) {
      $args = $this->getArguments($this->translateArguments());
      return vsprintf($message, $args);
    }
    return $message;
  }

}
