<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\I18n\Messages;

use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Translators;

/**
 * Implements a factory for translatable messages
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class Msg {

  /**
   * Creates a new singular message
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

  /**
   * Creates a new plural message
   * 
   * @param  string $singular
   * @param  string $plural
   * @param  bool $isPlural
   * @param  array $args
   * @param  TranslatorInterface $translator
   * @return self new instance
   */
  public static function plural(string $singular, string $plural, bool $isPlural = false, array $args = [], TranslatorInterface $translator = null): PluralMessage {
    if ($translator === null) {
      $translator = Translators::instance()->get();
    }
    return new PluralMessage($singular, $plural, $args, $translator, $isPlural);
  }

}
