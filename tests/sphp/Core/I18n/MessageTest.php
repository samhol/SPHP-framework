<?php

namespace Sphp\Core\I18n;

class MessageTest extends \PHPUnit_Framework_TestCase {

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

  /**
   * @dataProvider singularMessagesAndArguments
   * @covers Sphp\Core\Filters\Ordinalizer::filter
   * @param string $messageId
   * @param scalar[] $args
   */
  public function testFinnish($messageId, $args, $expected) {
    $message = new Message($messageId, $args);
            $this->assertEquals($message->parseMessage(), $expected);
  }

}
