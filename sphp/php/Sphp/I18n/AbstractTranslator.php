<?php

/**
 * AbstractTranslator.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\I18n;

use Sphp\Config\Locale;

/**
 * Abstract implementation for natural language translator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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

  public function vsprintf(string $message, $args = null, bool $translateArgs = false): string {
    $m = $this->get($message);
    /* if ($args !== null) {
      if ($translateArgs) {
      $args = $this->get($args);
      }
      $m = vsprintf($m, is_array($args) ? $args : [$args]);
      } */
    return $this->execVsprintf($m, $args, $translateArgs);
  }

  public function vsprintfPlural(string $msgid1, string $msgid2, int $n, $args = null, bool $translateArgs = false): string {
    $m = $this->getPlural($msgid1, $msgid2, $n);
    if ($args !== null) {
      if ($translateArgs) {
        $args = $this->get($args);
      }
      $m = vsprintf($m, is_array($args) ? $args : [$args]);
    }
    return $m;
  }

  protected function execVsprintf(string $message, array $args = null, bool $translateArgs = false): string {
    if (!empty($args)) {
      $this->error = false;
      if ($translateArgs) {
        $args = $this->get($args);
      }
      $runner = new \Sphp\Config\ErrorHandling\ErrorExceptionThrower();
      $runner->start();
      $message = vsprintf($message, $args);
      $runner->stop();
    }
    return ""; //$message;
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
