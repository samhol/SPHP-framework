<?php

/**
 * PluralMessage.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n;

use Sphp\I18n\TranslatorInterface;

/**
 * Implements a translatable message object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PluralMessage extends AbstractMessage {

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
  private $n;

  /**
   * Constructs a new instance
   *
   * @param  string $msgid1 the singular message text
   * @param  string $msgid2 the plural message text
   * @param  null|mixed|mixed[] $args the arguments or null for no arguments
   * @param  TranslatorInterface|null $translator the translator component
   */
  public function __construct($msgid1, $msgid2, $n, $args = null, $translateArgs = false, TranslatorInterface $translator = null) {
    parent::__construct($args, $translateArgs, $translator);
    $this->setMessage($msgid1, $msgid2);
    $this->n = $n;
  }

  /**
   * @param  boolean $plural the number (e.g. item count) to determine the translation for the respective grammatical number
   * @return self for a fluent interface
   */
  public function isPlural($plural = true) {
    $this->n = $plural ? 2 : 1;
    return $this;
  }

  /**
   * @param  int $n the number (e.g. item count) to determine the translation for the respective grammatical number
   * @return self for a fluent interface
   */
  public function setItemCount($n) {
    $this->n = $n;
    return $this;
  }

  /**
   * Sets the message text
   *
   * @param  string $msgid1 the singular message text
   * @param  string $msgid2 the plural message text
   * @return self for a fluent interface
   */
  private function setMessage($msgid1, $msgid2) {
    $this->singular = $msgid1;
    $this->plural = $msgid2;
    return $this;
  }

  /**
   * Returns the message as formatted and translated string
   *
   * @return string the message as formatted and translated string
   */
  public function translate() {
    $message = $this->getTranslator()->getPlural($this->singular, $this->plural, $this->n, $this->getLang());
    if ($this->hasArguments()) {
      $args = $this->getArguments($this->translateArguments());
      return vsprintf($message, $args);
    }
    return $message;
  }

}
