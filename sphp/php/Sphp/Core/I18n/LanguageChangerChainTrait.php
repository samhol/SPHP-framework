<?php

/**
 * LanguageChangerChainTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

/**
 * Trait implements some of the methods defined in the {@link LanguageChangerChainInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait LanguageChangerChainTrait {

  use LanguageChangerTrait;

  /**
   * Sets the translator component for message translation
   *
   * @param  Translator $translator the translator component
   */
  public function notifyLanguageChange( $translator) {
    //echo "TranslatorChanged:" . $translator->getDomain();
    $this->setLang($translator);
  }

}
