<?php

namespace Sphp\Core\I18n;

require_once 'GettextDataTrait.php';

use Sphp\Core\I18n\Gettext\PoFileParser;

class MessageListTests extends \PHPUnit_Framework_TestCase {

  use GettextDataTrait;

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
  public function messages() {
    foreach ($this->plurals() as $data) {
      $arr[] = new PluralMessage($data[PoFileParser::SINGULAR_ID], $data[PoFileParser::PLURAL_ID], 2);
    }
    $arr[] = new Message('Could not write to log file: %s', 'file.txt');
    $arr[] = new Message('Please insert %s-%s characters', [3, 10]);
    return $arr;
  }

  /**
   */
  public function testInsert() {
    $pml = new PrioritizedMessageList();
    foreach ($this->messages() as $message) {
      $pml->insert($message);
      $this->assertTrue($pml->contains($message));
    }
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
