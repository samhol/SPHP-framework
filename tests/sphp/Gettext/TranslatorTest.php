<?php

namespace Sphp\Core\Gettext;

use Zend\I18n\Translator\Translator as ZendTranslator;
/**
 */
class TranslatorTest extends \PHPUnit_Framework_TestCase {

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
    bindtextdomain(\Sphp\DEFAULT_DOMAIN, \Sphp\LOCALE_PATH);
    bind_textdomain_codeset(\Sphp\DEFAULT_DOMAIN, 'UTF-8');
    $this->translator = new Translator('fi_FI');
    //putenv('LC_ALL=fi_FI');
    putenv('LC_ALL=fi_FI');
    //setlocale(\LC_ALL, 'fi_FI.utf8');
    //setlocale(\LC_ALL, ""); LC_CTYPE
    //setlocale(\LC_ALL, 'fi_FI.utf8');
    var_dump(getenv('LC_ALL'));
    var_dump(setLocale(\LC_ALL, "0"));
    //$locale = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
  }

  protected function setLocale($locale) {
    var_dump(setLocale(LC_ALL, "0"));
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
    $zendTranslator = new ZendTranslator();
    $zendTranslator->addTranslationFilePattern('gettext', 'D:\web_projects\SPHP-framework\sphp\locale', "%s\LC_MESSAGES\Sphp.Defaults.mo", 'Sphp.Defaults');
   var_dump($zendTranslator->translate("year", \Sphp\DEFAULT_DOMAIN, 'fi_FI'));
    var_dump($this->translator->get("year"));
    var_dump(\Sphp\LOCALE_PATH.'\%s\LC_MESSAGES\Sphp.Defaults.mo');
    //$this->assertEquals($this->translator->get("year"), "vuosi");
    //$this->assertEquals($this->translator->get("month", "en_US"), "month");
  }

}
