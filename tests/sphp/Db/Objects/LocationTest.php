<?php

namespace Sphp\Db\Objects;

use Sphp\Core\Configuration;
use Doctrine\ORM\EntityManagerInterface as EntityManagerInterface;

require_once 'AddressChainedSettingAndGettingTestTrait.php';

class LocationTest extends \PHPUnit_Framework_TestCase {

  use AddressChainedSettingAndGettingTestTrait;

  /**
   * @return array
   */
  public function addrs() {
    $data[] = [];
    $data[] = ['name' => 'home'];
    $data[] = ['name' => 'home', 'street' => 'Rakuunatie 59 A 3'];
    $data[] = ['name' => 'home', 'street' => 'Rakuunatie 59 A 3', 'city' => 'Turku'];
    $data[] = ['name' => 'home', 'street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720'];
    $data[] = ['name' => 'home', 'street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland'];
    $addresses = [];
    foreach ($data as $addrData) {
      $obj = new Location($addrData);
      $addresses[] = [$obj];
    }
    return $addresses;
  }

  /**
   *
   * @var EntityManagerInterface
   */
  protected $em;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->em = Configuration::useDomain("manual")
            ->get(EntityManagerInterface::class);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  /**
   * 
   * @return Address
   * @dataProvider userArrs
   */
  public function addressProvider(array $data) {
    return new Address($data);
  }

  /**
   * @dataProvider userArrs
   */
  public function testConstruct(array $data) {
    $u = new User($data);
    $a = $this->addressProvider($data);
    $this->assertEquals($u->getUsername(), $data["username"]);
    $this->assertEquals($u->getFname(), $data["fname"]);
    $this->assertEquals($u->getLname(), $data["lname"]);
    $this->assertEquals($u->getAddress(), $a);
  }

  /**
   * 
   */
  public function testInsert() {
    $obj = new Location(['name' => 'home', 'street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland']);
    $obj->insertAsNewInto($this->em);
  }

  /**
   * 
   * @dataProvider existingUsers
   */
  public function testUpdateFails(User $u) {
    $this->assertfalse($u->insertAsNewInto($this->em));
  }

  /**
   */
  public function testEquals() {
    $home = new Location(['street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland']);
    $this->assertTrue($home->equals($home));
    $this->assertFalse($home->equals(new Location()));
    $this->assertFalse($home->equals(new Address(['street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland'])));
    $this->assertFalse($home->equals(null));
  }

}
