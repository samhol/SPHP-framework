<?php

/**
 * AbstractTranslator.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\I18n;

/**
 * Abstract implementation for natural language translator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractTranslator implements TranslatorInterface {

  public function vsprintf($message, $args = null, $translateArgs = false) {
    $m = $this->get($message);
    if ($args !== null) {
      if ($translateArgs) {
        $args = $this->get($args);
      }
      $m = vsprintf($m, is_array($args) ? $args : [$args]);
    }
    return $m;
  }

  public function vsprintfPlural($msgid1, $msgid2, $n, $args = null, $translateArgs = false) {
    $m = $this->getPlural($msgid1, $msgid2, $n);
    if ($args !== null) {
      if ($translateArgs) {
        $args = $this->get($args);
      }
      $m = vsprintf($m, is_array($args) ? $args : [$args]);
    }
    return $m;
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
