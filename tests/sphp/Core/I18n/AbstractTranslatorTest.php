<?php

namespace Sphp\Core\I18n;

/**
 */
abstract class AbstractTranslatorTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var TranslatorInterface
   */
  protected $translator;

  /**
   * @return TranslatorInterface
   */
  abstract function getTranslator();
  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->translator = $this->getTranslator();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  /**
   */
  public function testSingular() {
    /*$zendTranslator = new ZendTranslator();
    $zendTranslator->addTranslationFilePattern('gettext', '..\sphp\locale', "%s\LC_MESSAGES\Sphp.Defaults.mo", 'Sphp.Defaults');
    echo "\n" . __DIR__ . "\n";
    var_dump($zendTranslator->translate("year", \Sphp\DEFAULT_DOMAIN, 'fi_FI'));
    var_dump($this->translator->get("year"));
    var_dump(\Sphp\LOCALE_PATH . '\%s\LC_MESSAGES\Sphp.Defaults.mo');*/
    //$this->translator->setLang('en_UK');
    $this->assertEquals($this->translator->get('year'), 'vuosi');
    //$this->assertEquals($this->translator->get('year'), 'year');
  }

  /**
   */
  public function testPlural() {
    $this->assertEquals($this->translator->getPlural('%d directory', '%d directories', 0), '%d hakemistoa');
    $this->assertEquals($this->translator->getPlural('%d directory', '%d directories', 1), '%d hakemisto');
    $this->assertEquals($this->translator->getPlural('%d directory', '%d directories', 2), '%d hakemistoa');
    $this->assertEquals($this->translator->getPlural('%d directory', '%d directories', -3), '%d hakemistoa');
    //$this->translator->setLang('en_US');
    //$this->assertEquals($this->translator->getPlural('%d directory', '%d directories', -3), '%d directories');
  }

}
