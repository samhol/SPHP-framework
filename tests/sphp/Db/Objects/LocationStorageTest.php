<?php

namespace Sphp\Db\Objects;

use Doctrine\ORM\EntityManagerInterface as EntityManagerInterface;

require_once 'AddressChainedSettingAndGettingTestTrait.php';

class LocationStorageTest extends \PHPUnit_Framework_TestCase {

  /**
   * @return array
   */
  public function locations() {
    $data[] = ['name' => 'a', 'street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland'];
    $data[] = ['name' => 'b', 'street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland'];
    $data[] = ['name' => 'c', 'street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland'];
    $data[] = ['name' => 'foo', 'street' => 'foo 3', 'city' => 'foo', 'zipcode' => '000', 'country' => 'fooland'];
    $data[] = ['name' => 'home', 'street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland'];
    $addresses = [];
    foreach ($data as $addrData) {
      $obj = new Location($addrData);
      $addresses[] = $obj;
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
   * @var LocationStorage 
   */
  protected $locations;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->em = \Sphp\Db\EntityManagerFactory::get();
    $this->locations = new LocationStorage();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  /**
   * @depends testDelete
   */
  public function insertLocations() {
    foreach ($this->locations() as $location) {
      try {
        $this->em->persist($location);
        $this->em->flush();
      } catch (\Exception $ex) {
        echo $location->getName() . " allready exists\n";
      }
    }
    $this->em->clear();
  }

  /**
   * 
   */
  public function testDelete() {
    $this->insertLocations();
    $locations = $this->locations->findAll();
    foreach ($locations as $location) {
      $this->assertTrue($location instanceof Location);
      $this->locations->delete($location);
    }
  }

  /**
   * @depends testDelete
   */
  public function testFind() {
    $this->insertLocations();
    foreach($this->locations() as $location) {
      echo $this->locations->findByName($location->getName());
      
    }
    //$finnishLocations = $this->locations->findAllByCountry('Finland');
    //print_r($finnishLocations);
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
  public function testInsertDuplicate() {
    $foo = new Location(['name' => 'foo', 'street' => 'Rakuunatie 59 A 3', 'city' => 'Turku', 'zipcode' => '20720', 'country' => 'Finland']);
    $this->locations->removeByName($foo);

    $this->em->persist($foo);
    $this->em->flush();
    $this->assertTrue($this->em->contains($foo));
    $foo1 = new Location(['name' => 'foo', 'street' => 'foo1', 'city' => 'foo1', 'zipcode' => 'foo1', 'country' => 'foo1']);
    try {
      $this->em->persist($foo1);
      $this->em->flush();
      $this->assertTrue($this->em->contains($foo));
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
