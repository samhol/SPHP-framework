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
   * @param string $domain
   * @param string $name
   * @param mixed $value
   */
  public function testVariableSetting(array $domain, $locked) {
    $conf = new Config($domain, $locked);
    if (!$locked) {
      $conf->foo = 'bar';
      $this->assertEquals($conf->foo, 'bar');
      $conf->foo->a = 'bar';
      $this->assertEquals($conf->foo, 'bar');
    }
    print_r($conf);
    //$this->assertSame($domain, $conf);
  }

}
