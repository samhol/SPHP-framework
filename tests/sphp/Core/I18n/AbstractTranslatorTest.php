<?php

namespace Sphp\Core\I18n;

require_once 'GettextDataTrait.php';

use Sphp\Core\I18n\Gettext\PoFileParser;

abstract class AbstractTranslatorTest extends \PHPUnit_Framework_TestCase {

  use GettextDataTrait;

  /**
   * @var TranslatorInterface
   */
  protected $translator;

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
    unset($this->translator);
  }

  /**
   * @dataProvider allMessageStrings
   */
  public function testSingularGet(array $data) {
    $this->assertEquals($this->translator->get($data[PoFileParser::SINGULAR_ID]), $data[PoFileParser::SINGULAR_MESSAGE]);
  }

  /**
   * @dataProvider plurals
   * @param array $data
   */
  public function testPlural(array $data) {
    $this->assertEquals($this->translator->getPlural($data[PoFileParser::SINGULAR_ID], $data[PoFileParser::PLURAL_ID], 0), $data[PoFileParser::PLURAL_MESSAGE]);
    $this->assertEquals($this->translator->getPlural($data[PoFileParser::SINGULAR_ID], $data[PoFileParser::PLURAL_ID], 1), $data[PoFileParser::SINGULAR_MESSAGE]);
    $this->assertEquals($this->translator->getPlural($data[PoFileParser::SINGULAR_ID], $data[PoFileParser::PLURAL_ID], 2), $data[PoFileParser::PLURAL_MESSAGE]);
    $this->assertEquals($this->translator->getPlural($data[PoFileParser::SINGULAR_ID], $data[PoFileParser::PLURAL_ID], -3), $data[PoFileParser::PLURAL_MESSAGE]);
  }

  public function arrayData() {
    $d = [];
    $d[] = [[], []];
    $d[] = [['one' => 'one'], ['one' => 'yksi']];
    $d[] = [
        ["open", ["save", "delete", ["update"]], "close"],
        ["avaa", ["tallenna", "poista", ["päivitä"]], "sulje"]
    ];
    return $d;
  }

  /**
   * @dataProvider arrayData
   */
  public function testArrayTranslation(array $raw, array $expected) {
    $this->assertEquals($this->translator->get($raw), $expected);
  }

}
