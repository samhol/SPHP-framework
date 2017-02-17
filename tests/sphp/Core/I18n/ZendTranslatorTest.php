<?php

namespace Sphp\Core\I18n\Zend;

require_once 'AbstractTranslatorTest.php';

use Sphp\Core\I18n\AbstractTranslatorTest;

class ZendTranslatorTests extends AbstractTranslatorTest {

  public function getTranslator() {
    return (new Translator('fi_FI'))
                    ->addTranslationFilePattern('gettext', __DIR__ . '/locale/', "%s\LC_MESSAGES\Sphp.Defaults.mo", 'Sphp.Defaults')
                    ->setUsedDomain('Sphp.Defaults');
  }

  /**
   * @dataProvider plurals
   * @param array $data
   */
  public function testPlural(\Sphp\Core\I18n\Gettext\PluralGettextData $data) {
    parent::testPlural($data);
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
