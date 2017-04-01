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
   * @param  string $singular the singular message text
   * @param  string $plural the plural message text
   * @param  null|mixed|mixed[] $args the arguments or null for no arguments
   * @param  TranslatorInterface|null $translator the translator component
   */
  public function __construct($singular, $plural, $n, $args = null, $translationRule = self::TRANSLATE_MESSAGE, TranslatorInterface $translator = null) {
    parent::__construct($args, $translationRule, $translator);
    $this->setMessage($singular, $plural);
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
   * @param  string $singular the singular message text
   * @param  string $plural the plural message text
   * @return self for a fluent interface
   */
  private function setMessage($singular, $plural) {
    $this->singular = $singular;
    $this->plural = $plural;
    return $this;
  }

  /**
   * 
   * @return string message
   */
  public function getMessage() {
    if ($this->translatesMessage()) {
      return $this->getTranslator()->getPlural($this->singular, $this->plural, $this->n, $this->getLang());
    } else if ($this->n > 1) {
      return $this->plural;
    } else {
      return $this->singular;
    }
  }

}
