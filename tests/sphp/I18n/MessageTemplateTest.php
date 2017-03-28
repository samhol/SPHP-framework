<?php

namespace Sphp\I18n;

use Sphp\I18n\Gettext\PoFileIterator;

class MessageTemplateTest extends \PHPUnit_Framework_TestCase {

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
    $m = new MessageTemplate($data->getMessageId());
    $this->assertFalse($m->isPlural());
    $this->assertInstanceOf(MessageInterface::class, $m->generate());
    $this->assertInstanceOf(Message::class, $m->generate());
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
    $m = new MessageTemplate($data->getMessageId(), $data->getPluralId());
    $this->assertTrue($m->isPlural());
    $this->assertInstanceOf(MessageInterface::class, $m->generate());
    $this->assertInstanceOf(PluralMessage::class, $m->generate());
  }

}
