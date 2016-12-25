<?php

namespace Sphp\Core\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase {

  public function configDomain1Data() {
    return [
        [["domain1" => ["string" => "string"]], false],
        [["domain1" => ["int" => 1]], true],
        [["domain1" => ["bool" => false]], true],
        [["domain1" => ["array" => ["first" => 1, 2, 3]]], true],
        [["domain1" => ["obj" => new \stdClass()]], true]
    ];
  }

  /**
   * @dataProvider configDomain1Data
   *
   * @param string $config
   * @param string $name
   * @param mixed $value
   */
  public function testVariableSetting(array $config, $locked) {
    $conf = new Config($config, $locked);
    if (!$locked) {
      $conf->foo = ['bar' => 'foobar'];
      $this->assertEquals($conf->foo->bar, 'foobar');
      $conf->foo->a = 'bar';
      $this->assertEquals($conf->foo->a, 'bar');
    }
    print_r($conf);
    //$this->assertSame($domain, $conf);
  }

}
