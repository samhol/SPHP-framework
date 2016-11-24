<?php

namespace Sphp\Core\I18n\Zend;

require_once 'AbstractTranslatorTest.php';

use Sphp\Core\I18n\AbstractTranslatorTest;

/**
 */
class ZendTranslatorTest extends AbstractTranslatorTest {

  public function getTranslator() {
    return new Translator('fi_FI');
  }

  /**
   * @var Translator
   */
  protected $translator;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    //$this->setLocale("fi_FI");
    //bindtextdomain(\Sphp\DEFAULT_DOMAIN, \Sphp\LOCALE_PATH);
    //bind_textdomain_codeset(\Sphp\DEFAULT_DOMAIN, 'UTF-8');
    $this->translator = new Translator('fi_FI');
    putenv('LC_ALL=en_utf8');
    var_dump(getenv('LC_ALL'));
    //putenv('LC_ALL=fi_FI');
    setlocale(\LC_ALL, 'en_utf8');
    //setlocale(\LC_ALL, ""); LC_CTYPE
    //setlocale(\LC_ALL, 'fi_FI.utf8');
    var_dump(setLocale(\LC_ALL, "0"));
    //$locale = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
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
    /* $zendTranslator = new ZendTranslator();
      $zendTranslator->addTranslationFilePattern('gettext', '..\sphp\locale', "%s\LC_MESSAGES\Sphp.Defaults.mo", 'Sphp.Defaults');
      echo "\n" . __DIR__ . "\n";
      var_dump($zendTranslator->translate("year", \Sphp\DEFAULT_DOMAIN, 'fi_FI'));
      var_dump($this->translator->get("year"));
      var_dump(\Sphp\LOCALE_PATH . '\%s\LC_MESSAGES\Sphp.Defaults.mo'); */
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
