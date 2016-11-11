<?php

namespace Sphp\Db\Objects;

require_once 'AddressChainedSettingAndGettingTestTrait.php';

class AddressTest extends \PHPUnit_Framework_TestCase {

  use AddressChainedSettingAndGettingTestTrait;

  /**
   * @return array
   */
  public function addrs() {
    $data[] = [];
    $data[] = ['street' => 'Rakuunatie 59 A 3'];
    $data[] = ['street' => 'Rakuunatie 59 A 3', 'city' => 'Turku'];
    $data[] = ['street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720'];
    $data[] = ['street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland'];
    $addresses = [];
    foreach ($data as $addrData) {
      $addr = new Address($addrData);
      $addresses[] = [$addr];
    }
    return $addresses;
  }

  /**
   */
  public function testEquals() {
    $home = new Address(['street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland']);
    $this->assertTrue($home->equals($home));
    $this->assertFalse($home->equals(new Address()));
    $this->assertFalse($home->equals(null));
  }

}
