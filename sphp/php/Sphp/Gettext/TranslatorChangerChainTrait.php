<?php

/**
 * TranslatorChangerChainTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Gettext;

/**
 * Trait implements some of the methods defined in the {@link TranslatorChangerChainInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-18
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait TranslatorChangerChainTrait {

  use TranslatorChangerTrait;

  /**
   * Sets the translator component for message translation
   *
   * @param  Translator $translator the translator component
   */
  public function notifyTranslatorChange(Translator $translator) {
    //echo "TranslatorChanged:" . $translator->getDomain();
    $this->setTranslator($translator);
  }

}
