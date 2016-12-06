<?php

namespace Sphp\Core\I18n;

require_once 'GettextDataTrait.php';

use Sphp\Core\I18n\Gettext\PoFileIterator;

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
   * @dataProvider singulars
   */
  public function testSingularMessages(Gettext\GettextData $data) {
   /* echo "\narray?::\n";
    print_r($this->translator->get($data->getMessageId()));
    echo "\n";
    print_r($data->getMessageId());
    echo "\n";*/
    $this->assertEquals($this->translator->get($data->getMessageId()), $data->getTranslation());
  }

  /**
   * @dataProvider plurals
   * @param array $data
   */
  public function testPlural(Gettext\PluralGettextData $data) {
    $this->assertEquals($this->translator->getPlural($data->getMessageId(), $data->getPluralId(), 0), $data->getPluralTranslation());
    $this->assertEquals($this->translator->getPlural($data->getMessageId(), $data->getPluralId(), 1), $data->getTranslation());
    $this->assertEquals($this->translator->getPlural($data->getMessageId(), $data->getPluralId(), 2), $data->getPluralTranslation());
    $this->assertEquals($this->translator->getPlural($data->getMessageId(), $data->getPluralId(), -3), $data->getPluralTranslation());
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
