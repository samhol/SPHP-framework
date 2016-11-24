<?php

namespace Sphp\Core\I18n\Zend;

require_once 'AbstractTranslatorTest.php';

use Sphp\Core\I18n\AbstractTranslatorTest;

/**
 */
class ZendTranslatorTest extends AbstractTranslatorTest {

  public function getTranslator() {
    var_dump(\Sphp\LOCALE_PATH . '\%s\LC_MESSAGES\Sphp.Defaults.mo');
    return (new Translator('fi_FI'))
                    ->addTranslationFilePattern('gettext', \Sphp\LOCALE_PATH, "%s\LC_MESSAGES\Sphp.Defaults.mo", 'Sphp.Defaults')
                    ->setUsedDomain('Sphp.Defaults');
  }

  /**
   */
  public function testSingular() {
    $this->assertEquals($this->translator->get('year'), 'vuosi');
  }

  /**
   */
  public function testPlural() {
    $this->assertEquals($this->translator->getPlural('%d directory', '%d directories', 0), '%d hakemistoa');
    $this->assertEquals($this->translator->getPlural('%d directory', '%d directories', 1), '%d hakemisto');
    $this->assertEquals($this->translator->getPlural('%d directory', '%d directories', 2), '%d hakemistoa');
    $this->assertEquals($this->translator->getPlural('%d directory', '%d directories', -3), '%d hakemistoa');
    $this->translator->setLang('en_US');
    $this->assertEquals($this->translator->getPlural('%d directory', '%d directories', -3), '%d directories');
  }

}
