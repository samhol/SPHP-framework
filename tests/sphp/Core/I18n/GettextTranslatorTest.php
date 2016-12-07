<?php

namespace Sphp\Core\I18n\Gettext;

require_once 'AbstractTranslatorTest.php';

use Sphp\Core\I18n\AbstractTranslatorTest;

/**
 */
class GettextTranslatorTests extends AbstractTranslatorTest {

  /**
   * @var Translator
   */
  protected $translator;

  /**
   * 
   * @return Translator
   */
  public function getTranslator() {
    return new Translator('fi_FI');
  }

}
