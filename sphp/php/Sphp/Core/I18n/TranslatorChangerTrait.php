<?php

/**
 * TranslatorChangerTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

/**
 * Trait implements some of the methods defined in the {@link TranslatorChangerInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait TranslatorChangerTrait {

  /**
   * contains all {@link TranslatorChangeObserverInterface} observers
   *
   * @var \SplObjectStorage
   */
  private $observers;

  /**
   * The translator object translating the messages
   *
   * @var Translator
   */
  private $translator;

  /**
   * Registers a {@link Translator} change observer
   *
   * @param  TranslatorChangerObserverInterface $o observer
   * @return self for PHP Method Chaining
   */
  public function registerTranslatorChangerObserver(TranslatorChangerObserverInterface $o) {
    if ($this->observers === null) {
      $this->observers = new \SplObjectStorage();
    }
    $this->observers->attach($o);
    return $this;
  }

  /**
   * Unregisters a {@link Translator} change observer
   *
   * @param  TranslatorChangerObserverInterface $o observer
   * @return self for PHP Method Chaining
   */
  public function unregisterTranslatorChangerObserver(TranslatorChangerObserverInterface $o) {
    if ($this->observers !== null) {
      $this->observers->detach($o);
    }
    return $this;
  }

  /**
   * Notifies all of the {@link TranslatorChangerObserverInterface} observers
   *
   * @param  Translator the translator component to pass on to the observers
   * @return self for PHP Method Chaining
   */
  public function notifyTranslatorChangeObservers(Translator $translator) {
    if ($this->observers !== null) {
      foreach ($this->observers as $observer) {
        $observer->notifyTranslatorChange($translator);
      }
    }
    return $this;
  }

  /**
   * Sets the translator component for message translation
   *
   * @param  Translator $translator the translator component
   * @return self for PHP Method Chaining
   * @uses   self::notifyTranslatorChangeObservers()
   */
  public function setTranslator(Translator $translator) {
    $this->translator = $translator;
    $this->notifyTranslatorChangeObservers($translator);
    return $this;
  }

  /**
   * Returns the translator component used for message translation
   *
   * @return Translator the translator component
   */
  public function getTranslator() {
    if ($this->translator === null) {
      $this->setTranslator(new Translator());
    }
    return $this->translator;
  }

}
