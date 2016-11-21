<?php

/**
 * LanguageChangerObserverInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\Gettext;

/**
 * Interface models an observer for {@link LanguageChangerInterface} objects
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface LanguageChangerObserverInterface {

  /**
   * Notifying method called by all of the {@link LanguageChangerInterface} objects observed
   *
   * @param  string $translator the translator component passed on to the observer
   */
  public function notifyLanguageChange($translator);
}
