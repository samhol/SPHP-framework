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
   *
   * @var Locations 
   */
  protected $locations;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->em = Configuration::useDomain("manual")
            ->get(EntityManagerInterface::class);
    $this->locations = new Locations($this->em);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  /**
   */
  public function testSettingAndGetting() {
    $home = new Location();
    $home->setName('Home');
    $this->assertSame($home->getName(), 'Home');
    $home->setStreet('Rakuunatie 59 A 3');
    $this->assertSame($home->getStreet(), 'Rakuunatie 59 A 3');
    $home->setCity('Turku');
    $this->assertSame($home->getCity(), 'Turku');
    $home->setZipcode('20720');
    $this->assertSame($home->getZipcode(), '20720');
    $home->setCountry('Finland');
    $this->assertSame($home->getCountry(), 'Finland');
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
   * 
   */
  public function atestConstruct(array $data) {
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
  public function testDelete() {
    $l = $this->locations->findByName("home");
    //var_dump($l);
    echo "ID:";
    var_dump($l->getPrimaryKey());
    $this->assertTrue($l instanceof Location);
    $this->assertTrue($this->locations->delete($l));
    $this->locations->nameNotUsed("home");
    // $this->assertfalse($u->insertAsNewInto($this->em)); 
  }

  /**
   * @depends testDelete
   */
  public function testFind() {
    $finnishLocations = $this->locations->findAllByCountry('Finland');
    print_r($finnishLocations);
  }

  /**
   * @depends testDelete
   */
  public function testInsert() {
    $obj = new Location(['name' => 'home', 'street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland']);
    $obj->insertAsNewInto($this->em);
  }

  /**
   * @depends testInsert
   */
  public function testUpdate() {
    $l = $this->locations->findByName("home");
    $l->setCity("Åbo");
    //var_dump($l);
    echo "ID:";
    var_dump($l->getPrimaryKey());
    $this->locations->getManager()->flush();
    $this->assertTrue($this->locations->exists($l));
    // $this->assertfalse($u->insertAsNewInto($this->em)); 
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

  /**
   */
  public function testInsertDuplicate() {
    $foo = new Location(['name' => 'foo', 'street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland']);
    $this->locations->removeByName($foo);
    $this->em->persist($foo);
    $this->em->flush();
    $this->assertTrue($this->em->contains($foo));
    $foo1 = new Location(['name' => 'foo', 'street' => 'foo1', 'city' => 'foo1', 'zipcode' => 'foo1', 'country' => 'foo1']);
    try {
      $this->em->persist($foo1);
      $this->assertTrue($this->em->contains($foo));
      $this->em->flush();
    } catch (\Doctrine\DBAL\Exception\UniqueConstraintViolationException $ex) {
      $this->assertFalse($this->locations->contains($foo1));
      // $this->assertTrue($this->locations->contains($foo));
      var_dump($ex->getMessage());
      var_dump($foo->getPrimaryKey());
      $this->assertTrue($foo->getPrimaryKey() > 0);
      $this->assertTrue($this->em->contains($foo));
    }
  }

}
