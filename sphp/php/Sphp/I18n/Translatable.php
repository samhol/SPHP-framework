<?php

/**
 * TranslatorAwareInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n;

/**
 * Defines properties for translatable component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface Translatable {

  /**
   * Sets the translator component for message translation
   *
   * @param  TranslatorInterface $translator the translator component
   * @return $this for a fluent interface
   */
  public function setTranslator(TranslatorInterface $translator);

  /**
   * Translates the content using the given translator
   *
   * @param  TranslatorInterface $translator the translator component
   * @return string|string[] the content as a translated string
   */
  public function translateWith(TranslatorInterface $translator);

  /**
   * Translates the content
   *
   * @return string|string[] the content as a translated string
   */
  public function translate();
}
