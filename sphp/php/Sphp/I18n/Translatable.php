<?php

/**
 * TranslatorAwareInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n;

/**
 * Description of TranslatorAwareInterface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-05-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface Translatable {

  /**
   * Translates the content to given language
   *
   * @return string the content as a translated string
   */
  public function translateTo(string $lang): string;

  /**
   * Translates the content
   *
   * @return string the content as a translated string
   */
  public function translate(): string;

  /**
   * Returns the translated text
   *
   * @return string the translated text
   */
  public function __toString(): string;
}
