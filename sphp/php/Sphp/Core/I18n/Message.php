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
   * @param  string $message message text
   * @param  null|mixed|mixed[] $args the arguments or null for no arguments
   * @param  TranslatorInterface|null $translator the translator component
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
    //var_dump($this->getTranslator()->getLang());
    //var_dump(ini_get("LC_ALL"));
    //var_dump(setLocale(\LC_MESSAGES, '0'));
    return $this->getTranslator()->vsprintf($this->message, $this->getArguments());
  }

}
