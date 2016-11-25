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
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  public function getTranslator() {
    return new Translator('fi_FI');
  }

}
