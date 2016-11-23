<?php

/**
 * LanguageChangerTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

/**
 * Trait implements some of the methods defined in the {@link LanguageChangerInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait LanguageChangerTrait {

  /**
   * contains all {@link TranslatorChangeObserverInterface} observers
   *
   * @var \SplObjectStorage
   */
  private $observers;

  /**
   * Registers a {@link Translator} change observer
   *
   * @param  LanguageChangerObserverInterface $o observer
   * @return self for PHP Method Chaining
   */
  public function registerLanguageChangerObserver(LanguageChangerObserverInterface $o) {
    if ($this->observers === null) {
      $this->observers = new \SplObjectStorage();
    }
    $this->observers->attach($o);
    return $this;
  }

  /**
   * Unregisters a {@link Translator} change observer
   *
   * @param  LanguageChangerObserverInterface $o observer
   * @return self for PHP Method Chaining
   */
  public function unregisterLanguageChangerObserver(LanguageChangerObserverInterface $o) {
    if ($this->observers !== null) {
      $this->observers->detach($o);
    }
    return $this;
  }

  /**
   * Notifies all of the {@link LanguageChangerObserverInterface} observers
   *
   * @param  string $lang the translator component to pass on to the observers
   * @return self for PHP Method Chaining
   */
  public function notifyLanguageChangeObservers($lang) {
    if ($this->observers !== null) {
      foreach ($this->observers as $observer) {
        $observer->notifyLanguageChange($lang);
      }
    }
    return $this;
  }

  /**
   * Sets the translator component for message translation
   *
   * @param  string $lang the translator component
   * @return self for PHP Method Chaining
   * @uses   self::notifyTranslatorChangeObservers()
   */
  public function setLang($lang) {
    $this->getTranslator()->setLang($lang);
    return $this;
  }

  /**
   * Returns the translator component used for message translation
   *
   * @return Translator the translator component
   */
  abstract public function getTranslator();
}
