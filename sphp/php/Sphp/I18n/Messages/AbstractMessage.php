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
use Sphp\I18n\Translators;
use Sphp\Stdlib\Arrays;

/**
 * Abstract implementation of a translatable message
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractMessage implements Message {

  /**
   * original raw message arguments
   *
   * @var scalar[]
   */
  private $args;

  /**
   * @var bool
   */
  private $translateArgs;

  /**
   * The translator object translating the messages
   *
   * @var Translator
   */
  private $translator;

  /**
   * Constructor
   *
   * @param  array $args optional arguments or null for no arguments
   * @param  TranslatorInterface|null $translator the translator component
   */
  public function __construct(array $args = [], TranslatorInterface $translator = null) {
    $this->setArguments($args);
    if ($translator !== null) {
      $this->setTranslator($translator);
    }
    $this->translateArgs = false;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->args, $this->translator);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->args = Arrays::copy($this->args);
  }

  public function __toString(): string {
    try {
      return $this->translate();
    } catch (\Throwable $ex) {
      return "$ex";
    }
  }

  public function getFormattedTemplate(): string {
    return vsprintf($this->getTemplate(), $this->getRawArguments());
  }

  public function setArguments(array $args) {
    $this->args = $args;
    return $this;
  }

  public function hasArguments(): bool {
    return !empty($this->args);
  }

  public function getRawArguments(): array {
    return $this->args;
  }

  public function getArguments(): array {
    if (!empty($this->args) && $this->translateArgs) {
      return $this->getTranslator()->translateArray($this->args);
    } else {
      return $this->args;
    }
  }

  public function translateArguments(bool $translateArguments = true) {
    $this->translateArgs = $translateArguments;
    return $this;
  }

  public function translatesArguments(): bool {
    return $this->translateArgs;
  }

  public function setTranslator(TranslatorInterface $translator) {
    $this->translator = $translator;
    return $this;
  }

  public function getTranslator(): TranslatorInterface {
    return $this->translator;
  }

  public function translate(): string {
    return $this->translateWith($this->getTranslator());
  }

  /**
   * 
   * @param string $message
   * @param array $args
   * @param TranslatorInterface $translator
   * @return self new instance
   */
  public static function singular(string $message, array $args = [], TranslatorInterface $translator = null): SingularMessage {
    if ($translator === null) {
      $translator = Translators::instance()->get();
    }
    return new SingularMessage($message, $args, $translator);
  }


}
