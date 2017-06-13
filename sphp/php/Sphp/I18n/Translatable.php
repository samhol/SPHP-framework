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
   * Sets the translator component for message translation
   *
   * @param  TranslatorInterface $translator the translator component
   * @return self for a fluent interface
   */
  public function setTranslator(TranslatorInterface $translator);

  /**
   * Returns the translator component used for message translation
   *
   * @return TranslatorInterface the translator component
   */
  public function getTranslator();

  /**
   * Returns the translated text
   *
   * @return string the translated text
   */
  public function __toString(): string;
}
