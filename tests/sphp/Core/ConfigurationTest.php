<?php

namespace Sphp\Core;

class ConfigurationTest extends \PHPUnit_Framework_TestCase {

  public function configDomain1Data() {
    return [
        ["domain1", "string", "string"],
        ["domain1", "int", 1],
        ["domain1", "bool", false],
        ["domain1", "array", ["first" => 1, 2, 3]],
        ["domain1", "obj", new \stdClass()]
    ];
  }

  /**
   * @dataProvider configDomain1Data
   *
   * @param string $domain
   * @param string $name
   * @param mixed $value
   */
  public function testVariableSetting($domain, $name, $value) {
    $conf = Configuration::useDomain($domain);
    $conf->set($name, $value);
    $this->assertTrue($conf->get($name)=== $value);
  }

}
