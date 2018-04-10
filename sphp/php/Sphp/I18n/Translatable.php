<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n;

/**
 * Defines properties for translatable component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
