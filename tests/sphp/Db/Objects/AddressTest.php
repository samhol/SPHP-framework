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
    $home = new Address($data);
    $this->assertTrue($home->equals((new Address())->fromArray($data)));
    $this->assertFalse($home->equals(new Address()));
    $this->assertFalse($home->equals(null));
  }

  /**
   */
  public function testSettingAndGetting() {
    $home = new Address();
    $home->setStreet('Rakuunatie 59 A 3');
    $this->assertSame($home->getStreet(), 'Rakuunatie 59 A 3');
    $home->setCity('Turku');
    $this->assertSame($home->getCity(), 'Turku');
    $home->setZipcode('20720');
    $this->assertSame($home->getZipcode(), '20720');
    $home->setCountry('Finland');
    $this->assertSame($home->getCountry(), 'Finland');
  }

}
