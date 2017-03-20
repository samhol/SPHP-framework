<?php

namespace Sphp\I18n;

use Sphp\I18n\Gettext\PoFileIterator;

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
      self::$parser = new PoFileIterator(\Sphp\LOCALE_PATH . '\fi_FI\LC_MESSAGES\Sphp.Defaults.po');
    }
    return self::$parser;
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
    foreach ($parser as $data) {
      $args[] = [$data];
    }
    return $args;
  }

  /**
   * @dataProvider allMessageStrings
   * @param array $data
   */
  public function testSingular(Gettext\GettextData $data) {
    $m = new Message($data->getMessageId());
    $this->assertEquals($m->translate(), $data->getTranslation());
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
  public function testPlural(Gettext\PluralGettextData $data) {
    $m = new PluralMessage($data->getMessageId(), $data->getPluralId(), 0);
    $this->assertEquals($m->setItemCount(0)->translate(), $data->getPluralTranslation());
    $this->assertEquals($m->setItemCount(1)->translate(), $data->getTranslation());
    $this->assertEquals($m->setItemCount(2)->translate(), $data->getPluralTranslation());
    $this->assertEquals($m->isPlural(false)->translate(), $data->getTranslation());
    $this->assertEquals($m->isPlural()->translate(), $data->getPluralTranslation());
  }

}
