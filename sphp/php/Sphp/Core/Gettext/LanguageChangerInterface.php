<?php

/**
 * LanguageChangerInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\Gettext;

/**
 * Interface models a Translator changer
 *
 * Translator changer simply notifies its observers of a {@link Translator} change.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface LanguageChangerInterface {

  /**
   * Registers a {@link Translator} change observer
   *
   * @param  LanguageChangerObserverInterface $o observer
   * @return self for PHP Method Chaining
   */
  public function registerLanguageChangerObserver(LanguageChangerObserverInterface $o);

  /**
   * Unregisters a {@link Translator} change observer
   *
   * @param  LanguageChangerObserverInterface $o observer
   * @return self for PHP Method Chaining
   */
  public function unregisterLanguageChangerObserver(LanguageChangerObserverInterface $o);

  /**
   * Notifies all of the {@link LanguageChangerObserverInterface} observers
   *
   * @param  Translator the translator component to pass on to the observers
   * @return self for PHP Method Chaining
   */
  public function notifyLanguageChangeObservers($translator);
}
