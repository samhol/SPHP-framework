<?php

/**
 * TranslatorChangerObserverInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

/**
 * Interface models an observer for {@link TranslatorChangerInterface} objects
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TranslatorChangerObserverInterface {

  /**
   * Notifying method called by all of the {@link TranslatorChangerInterface} objects observed
   *
   * @param  Translator the translator component passed on to the observer
   */
  public function notifyTranslatorChange(Translator $translator);
}
