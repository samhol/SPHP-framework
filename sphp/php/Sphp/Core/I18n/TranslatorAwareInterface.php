<?php

/**
 * TranslatorAwareInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

/**
 * Description of TranslatorAwareInterface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-05-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TranslatorAwareInterface {

  /**
   * Sets the translator component for message translation
   *
   * @param  TranslatorInterface $translator the translator component
   * @return self for PHP Method Chaining
   */
  public function setTranslator(TranslatorInterface $translator);

  /**
   * Returns the translator component used for message translation
   *
   * @return TranslatorInterface the translator component
   */
  public function getTranslator();

  /**
   * Sets the translator component for message translation
   *
   * @param  string $lang the translator component
   * @return self for PHP Method Chaining
   */
  public function setLang($lang);

  /**
   * Sets the translator component for message translation
   *
   * @return self for PHP Method Chaining
   */
  public function getLang();
}
