<?php

namespace Sphp\Core\I18n;

use Sphp\Core\I18n\Gettext\PoParser;

class MessageListTests extends \PHPUnit_Framework_TestCase {

  /**
   *
   * @var PoParser 
   */
  private $entries;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    //$fileHandler = new FileHandler(\Sphp\LOCALE_PATH . '\fi_FI\LC_MESSAGES\Sphp.Defaults.po');
    //if ($this->entries === null) {
    $this->entries = new PoParser(\Sphp\LOCALE_PATH . '\fi_FI\LC_MESSAGES\Sphp.Defaults.po');
    print_r($this->entries->getSingularIds());
    print_r($this->entries->getPlurals());
    //}
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  public function singulars() {
    return $this->entries->getSingulars();
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
    $parser = new PoParser(\Sphp\LOCALE_PATH . '\fi_FI\LC_MESSAGES\Sphp.Defaults.po');
    $args = [];
    foreach($parser->getPlurals() as $data) {
      $args[] = [$data];
    }
    return $args;
  }

  /**
   * @dataProvider plurals
   * @param array $data
   */
  public function testPlural(array $data) {
    $m = new PluralMessage($data[PoParser::SINGULAR_ID], $data[PoParser::PLURAL_ID], 0);
    $this->assertEquals($m->setItemCount(0)->translate(), $data[PoParser::PLURAL_MESSAGE]);
    $this->assertEquals($m->setItemCount(1)->translate(), $data[PoParser::SINGULAR_MESSAGE]);
    $this->assertEquals($m->setItemCount(2)->translate(), $data[PoParser::PLURAL_MESSAGE]);
    $this->assertEquals($m->isPlural(false)->translate(), $data[PoParser::SINGULAR_MESSAGE]);
    $this->assertEquals($m->isPlural()->translate(), $data[PoParser::PLURAL_MESSAGE]);
  }

}
