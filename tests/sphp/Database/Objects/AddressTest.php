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
    $data = ['street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland'];
    $home1 = new Address($data);
    $home2 = new Address($data);
    $this->assertTrue($home1->equals((new Address())->fromArray($data)));
    $this->assertTrue($home1->equals($home2));
    $this->assertFalse($home1->equals(new Address()));
    $this->assertFalse($home1->equals(null));
  }

  /**
   * @return array
   */
  public function arrayData() {
    $data[] = [[]];
    $data[] = [['street' => 'Rakuunatie 59 A 3']];
    $data[] = [['street' => 'Rakuunatie 59 A 3', 'city' => 'Turku']];
    $data[] = [['street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720']];
    $data[] = [['street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland']];
    return $data;
  }

  /**
   * @dataProvider arrayData
   * @param array $data
   */
  public function testToArray(array $data) {
    $addr = new Address($data);
    $toArray = $addr->toArray();
    foreach ($data as $k => $v) {
      $this->assertSame($toArray[$k], $v);
    }
  }

}
