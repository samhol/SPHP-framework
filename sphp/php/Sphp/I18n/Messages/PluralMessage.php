<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n\Messages;

use Sphp\I18n\TranslatorInterface;

/**
 * Implements a plural translatable message object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
   * Constructor
   *
   * @param  string $singular the singular message text
   * @param  string $plural the plural message text
   * @param array $args
   * @param  TranslatorInterface|null $translator the translator component
   * @param  null|mixed|mixed[] $isPlural the arguments or null for no arguments
   */
  public function __construct(string $singular, string $plural, array $args = [], TranslatorInterface $translator = null, bool $isPlural = false) {
    parent::__construct($args, $translator);
    $this->singular = $singular;
    $this->plural = $plural;
    $this->setPlural($isPlural);
  }

  /**
   * @param  boolean $plural the number (e.g. item count) to determine the translation for the respective grammatical number
   * @return $this for a fluent interface
   */
  public function setPlural(bool $plural = true) {
    $this->n = $plural ? 2 : 1;
    return $this;
  }

  /**
   * 
   * @return boolean
   */
  public function isPlural(): bool {
    return $this->n > 1;
  }

  public function translateWith(TranslatorInterface $translator): string {
    return $translator->vsprintfPlural($this->singular, $this->plural, $this->n, $this->getArguments());
  }

  public function getTemplate(): string {
    return !$this->isPlural() ? $this->singular : $this->plural;
  }

}
