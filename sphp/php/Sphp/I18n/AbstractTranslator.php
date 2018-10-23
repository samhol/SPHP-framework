<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n;

use Sphp\Config\Locale;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Abstract implementation for natural language translator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractTranslator implements TranslatorInterface {

  /**
   * the charset of the translation file
   *
   * @var string
   */
  private $lang;

  public function getLang(): string {
    if ($this->lang === null) {
      return Locale::getMessageLocale();
    }
    return $this->lang;
  }

  public function setLang(string $lang = null) {
    $this->lang = $lang;
    return $this;
  }

  public function translateArray(array $messages): array {
    $output = [];
    foreach ($messages as $index => $value) {
      if (is_array($value)) {
        $value = $this->translateArray($value);
      } else if (is_string($value)) {
        $value = $this->get($value);
      }
      $output[$index] = $value;
    }
    return $output;
  }

  public function vsprintf(string $message, array $args = null, bool $translateArgs = false): string {
    return $this->format($this->get($message), $args, $translateArgs);
  }

  public function vsprintfPlural(string $msgid1, string $msgid2, int $n, array $args = null, bool $translateArgs = false): string {
    return $this->format($this->getPlural($msgid1, $msgid2, $n), $args, $translateArgs);
  }

  /**
   * 
   * @param  string $message
   * @param  array $args
   * @param  bool $translateArgs
   * @return string
   * @throws InvalidArgumentException if invalid number of arguments is presented
   */
  protected function format(string $message, array $args = null, bool $translateArgs = false): string {
    if (!empty($args)) {
      $thrower = ErrorToExceptionThrower::getInstance(InvalidArgumentException::class);
      $thrower->start();
      if ($translateArgs) {
        $args = $this->get($args);
      }
      $message = vsprintf($message, $args);
      $thrower->stop();
    }
    return $message;
  }

  /**
   * Executes the dictionary for the given value
   *
   * @param  mixed $text the value to filter
   * @return mixed the filtered value
   */
  public function __invoke($text) {
    $numArgs = func_num_args();
    $args = func_get_args();
    if ($numArgs === 1) {
      return $this->get($text);
    } else if ($numArgs === 2) {

      if (is_string($args[1])) {
        return $this->get($text, $args[1]);
      }
    } else if ($numArgs >= 3) {

      if (is_string($args[1]) && is_int($args[2])) {
        return $this->getPlural($text, $args[1], $args[1]);
      }
    }
    return $this->filter($text);
  }

}
