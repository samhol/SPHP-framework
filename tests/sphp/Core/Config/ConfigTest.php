<?php

namespace Sphp\Core\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase {

  public function configData1() {
    return [
        [["domain1" => ["string" => "string"]], true],
        [["domain1" => ["int" => 1]], true],
        [["domain1" => ["bool" => false]], true],
        [["domain1" => ["array" => ["first" => 1, 2, 3]]], true],
        [["domain1" => ["obj" => new \stdClass()]], true]
    ];
  }

  /**
   * @dataProvider configData1
   *
   * @param array $config
   * @param string $locked
   */
  public function testVariableSetting(array $config, $locked) {
    $conf = new Config($config, $locked);
    if (!$locked) {
      $conf->foo = ['bar' => 'foobar'];
      $this->assertEquals($conf->foo->bar, 'foobar');
      $this->assertFalse($conf->isReadOnly(), 'foobar');
      $conf->foo->a = 'bar';
      $this->assertEquals($conf->foo->a, 'bar');
    } else {
      $this->assertTrue($conf->isReadOnly());
    }
    $this->assertSame($config, $conf->toArray());
  }

}
