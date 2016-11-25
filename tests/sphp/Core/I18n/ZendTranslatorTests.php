<?php

namespace Sphp\Core\I18n\Zend;

require_once 'AbstractTranslatorTest.php';

use Sphp\Core\I18n\AbstractTranslatorTest;

/**
 */
class ZendTranslatorTests extends AbstractTranslatorTest {

  public function getTranslator() {
    var_dump(\Sphp\LOCALE_PATH . '\%s\LC_MESSAGES\Sphp.Defaults.mo');
    return (new Translator('fi_FI'))
                    ->addTranslationFilePattern('gettext', \Sphp\LOCALE_PATH, "%s\LC_MESSAGES\Sphp.Defaults.mo", 'Sphp.Defaults')
                    ->setUsedDomain('Sphp.Defaults');
  }

  public function testSingular() {
    $this->assertEquals($this->translator->get('year'), 'vuosi');
  }

  public function testPlural() {
    parent::testPlural();
    $this->translator->setLang('en_US');
    $this->assertEquals($this->translator->getPlural('%d directory', '%d directories', -3), '%d directories');
  }

  /**
   * @dataProvider arrayData
   */
  public function testArrayTranslation(array $raw, array $expected) {
    parent::testArrayTranslation($raw, $expected);
    $this->translator->setLang('en_US');
    $this->assertEquals($this->translator->get($raw), $raw);
  }

}
