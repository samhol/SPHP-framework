<?php

namespace Sphp\Core\I18n\Gettext;

require_once 'AbstractTranslatorTest.php';

use Sphp\Core\I18n\AbstractTranslatorTest;

/**
 */
class GettextTranslatorTest extends AbstractTranslatorTest {

  /**
   * @var Translator
   */
  protected $translator;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  public function getTranslator() {
    //$this->setLocale("fi_FI");
    //bindtextdomain(\Sphp\DEFAULT_DOMAIN, \Sphp\LOCALE_PATH);
    //bind_textdomain_codeset(\Sphp\DEFAULT_DOMAIN, 'UTF-8');
    return new Translator('fi_FI');
    //putenv('LC_ALL=en_utf8');
    //var_dump(getenv('LC_ALL'));
    //putenv('LC_ALL=fi_FI');
    //setlocale(\LC_ALL, 'en_utf8');
    //setlocale(\LC_ALL, ""); LC_CTYPE
    //setlocale(\LC_ALL, 'fi_FI.utf8');
    //var_dump(setLocale(\LC_ALL, "0"));
    //$locale = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);
  }

}
