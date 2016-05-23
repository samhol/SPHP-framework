<?php

/**
 * TranslatorChangerInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Gettext;

/**
 * Interface models a Translator changer
 *
 * Translator changer simply notifies its observers of a {@link Translator} change.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-18
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TranslatorChangerInterface {

  /**
   * Registers a {@link Translator} change observer
   *
   * @param  TranslatorChangerObserverInterface $o observer
   * @return self for PHP Method Chaining
   */
  public function registerTranslatorChangerObserver(TranslatorChangerObserverInterface $o);

  /**
   * Unregisters a {@link Translator} change observer
   *
   * @param  TranslatorChangerObserverInterface $o observer
   * @return self for PHP Method Chaining
   */
  public function unregisterTranslatorChangerObserver(TranslatorChangerObserverInterface $o);

  /**
   * Notifies all of the {@link TranslatorChangerObserverInterface} observers
   *
   * @param  Translator the translator component to pass on to the observers
   * @return self for PHP Method Chaining
   */
  public function notifyTranslatorChangeObservers(Translator $translator);
}
