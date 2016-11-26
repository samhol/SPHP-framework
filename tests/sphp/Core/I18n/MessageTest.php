<?php

namespace Sphp\Core\I18n;

use Sphp\Core\I18n\Gettext\PoFileParser;

class MessageTest extends \PHPUnit_Framework_TestCase {

  /**
   *
   * @var PoFileParser 
   */
  private static $parser;

  /**
   * 
   * @return PoFileParser
   */
  public static function getPoFileParser() {
    if (self::$parser === null) {
      self::$parser = new PoFileParser(\Sphp\LOCALE_PATH . '\fi_FI\LC_MESSAGES\Sphp.Defaults.po');
    }
    return self::$parser;
  }

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  /**
   * 
   * @return array
   */
  public function singularMessagesAndArguments() {
    $arr[] = [
        'Could not write to log file: %s',
        'file.txt',
        'Ei voitu kirjoittaa lokitiedostoon: file.txt'];
    $arr[] = [
        'Please insert %s-%s characters',
        [3, 10],
        'Syötä 3-10 merkkiä'];
    return $arr;
  }

  public function allMessageStrings() {
    $parser = self::getPoFileParser();
    $args = [];
    foreach ($parser->getAll() as $data) {
      $args[] = [$data];
    }
    return $args;
  }

  /**
   * @dataProvider allMessageStrings
   * @param array $data
   */
  public function testSingular(array $data) {
    $m = new Message($data[PoFileParser::SINGULAR_ID]);
    $this->assertEquals($m->translate(), $data[PoFileParser::SINGULAR_MESSAGE]);
  }

  /**
   * @dataProvider singularMessagesAndArguments
   * @covers Sphp\Core\Filters\Ordinalizer::filter
   * @param string $messageId
   * @param scalar[] $args
   */
  public function testFinnish($messageId, $args, $expected) {
    $message = new Message($messageId, $args);
    $this->assertEquals($message->translate(), $expected);
  }

  public function plurals() {
    $parser = self::getPoFileParser();
    $args = [];
    foreach ($parser->getPlurals() as $data) {
      $args[] = [$data];
    }
    return $args;
  }

  /**
   * @dataProvider plurals
   * @param array $data
   */
  public function testPlural(array $data) {
    $m = new PluralMessage($data[PoFileParser::SINGULAR_ID], $data[PoFileParser::PLURAL_ID], 0);
    $this->assertEquals($m->setItemCount(0)->translate(), $data[PoFileParser::PLURAL_MESSAGE]);
    $this->assertEquals($m->setItemCount(1)->translate(), $data[PoFileParser::SINGULAR_MESSAGE]);
    $this->assertEquals($m->setItemCount(2)->translate(), $data[PoFileParser::PLURAL_MESSAGE]);
    $this->assertEquals($m->isPlural(false)->translate(), $data[PoFileParser::SINGULAR_MESSAGE]);
    $this->assertEquals($m->isPlural()->translate(), $data[PoFileParser::PLURAL_MESSAGE]);
  }

}
