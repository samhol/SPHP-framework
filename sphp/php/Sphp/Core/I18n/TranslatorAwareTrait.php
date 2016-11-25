<?php

/**
 * TranslatorAwareTrait.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n;

/**
 * Trait implements some of the methods defined in the {@link TranslatorChangerInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait TranslatorAwareTrait {

  /**
   * The translator object translating the messages
   *
   * @var Translator
   */
  private $translator;

  /**
   * Sets the translator component for message translation
   *
   * @param  TranslatorInterface $translator the translator component
   * @return self for PHP Method Chaining
   */
  public function setTranslator(TranslatorInterface $translator) {
    $this->translator = $translator;
    return $this;
  }

  /**
   * Returns the translator component used for message translation
   *
   * @return TranslatorInterface the translator component
   */
  public function getTranslator() {
    if ($this->translator === null) {
      $this->setTranslator(new Translator());
    }
    return $this->translator;
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
   * Sets the translator component for message translation
   *
   * @return string the translator component
   */
  public function getLang() {
    return $this->getTranslator()->getLang();
  }

}
