<?php

/**
 * PluralTemplate.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n\Messages;

use Sphp\I18n\TranslatorInterface;

/**
 * Implements a translatable message object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PluralTemplate extends AbstractTemplate {

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
   * @param  TranslatorInterface|null $translator the translator component
   * @param  null|mixed|mixed[] $isPlural the arguments or null for no arguments
   */
  public function __construct(string $singular, string $plural, TranslatorInterface $translator, bool $isPlural = false) {
    parent::__construct($translator);
    $this->singular = $singular;
    $this->plural = $plural;
    $this->setPlural($isPlural);
  }

  /**
   * @param  boolean $plural the number (e.g. item count) to determine the translation for the respective grammatical number
   * @return self for a fluent interface
   */
  public function setPlural(bool $plural = true) {
    $this->n = $plural ? 2 : 1;
    return $this;
  }

  /**
   * @param  boolean $plural the number (e.g. item count) to determine the translation for the respective grammatical number
   * @return self for a fluent interface
   */
  public function isPlural(): bool {
    return $this->n > 1;
  }

  public function translate(): string {
    return $this->getTranslator()->getPlural($this->singular, $this->plural, $this->n);
  }

  public function translateTo(string $lang): string {
    return $this->getTranslator()->getPlural($this->singular, $this->plural, $this->n, $lang);
  }

}
