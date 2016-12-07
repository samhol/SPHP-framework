<?php

/**
 * PluralMessage.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

use Sphp\Core\I18n\TranslatorInterface;

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
  private $msgid1;

  /**
   * original raw plural message
   *
   * @var string
   */
  private $msgid2;

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
   * @return self for PHP Method Chaining
   */
  public function isPlural($plural = true) {
    $this->n = $plural ? 2 : 1;
    return $this;
  }

  /**
   * @param  int $n the number (e.g. item count) to determine the translation for the respective grammatical number
   * @return self for PHP Method Chaining
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
   * @return self for PHP Method Chaining
   */
  private function setMessage($msgid1, $msgid2) {
    $this->msgid1 = $msgid1;
    $this->msgid2 = $msgid2;
    return $this;
  }

  /**
   * Returns the message as formatted and translated string
   *
   * @return string the message as formatted and translated string
   */
  public function translate() {
    return $this->getTranslator()->vsprintfPlural($this->msgid1, $this->msgid2, $this->n, $this->getArguments(), false);
  }

}
