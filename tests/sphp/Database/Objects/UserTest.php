<?php

namespace Sphp\Db\Objects;

use Sphp\Configuration;
use Doctrine\ORM\EntityManagerInterface as EntityManagerInterface;

class UserTest extends \PHPUnit\Framework\TestCase {

  /**
   *
   * @var EntityManagerInterface
   */
  protected $em;
  /**
   *
   * @var Users
   */
  protected $users;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->em = Configuration::useDomain("manual")
            ->get(EntityManagerInterface::class);
    $this->users = new Users($this->em);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }
  
  public function testCount() {
    var_dump($this->users->count());
    $this->assertGreaterThanOrEqual(0, $this->users->count());
  }

  /**
   * 
   * @return array
   */
  public function userArrs() {
    return [
        [
            [
                "username" => "samhol",
                "fname" => "Sami",
                "lname" => "Holck"
            ],
            [
                "username" => "samhol",
                "fname" => "Sami",
                "lname" => "Holck",
                "street" => "Rakuunatie 59 A 3",
                "zipcode" => "20720",
                "city" => "Turku",
                "country" => "Finland"
            ]
        ]
    ];
  }

  /**
   * 
   * @return array
   */
  public function existingUsers() {
    $u = (new User())
            ->setUsername("samhol")
            ->setEmail("sami.holck@gmail.com")
            ->setFname("sami")
            ->setLname("holck");
    $u->getAddress()
            ->setStreet("Rakuunatie 59 A 3")
            ->setZipcode("20720")
            ->setCity("Turku")
            ->setCountry("Finland");
    $u1 = (new User())
            ->setUsername("samhol")
            ->setEmail("sami.holck@gmail.com")
            ->setFname("sami")
            ->setLname("holck");
    $u2 = (new User())
            ->setUsername("samhol");
    $u3 = (new User())
            ->setEmail("sami.holck@gmail.com");
    return [[$u, $u1, $u2, $u3]];
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
   * @dataProvider userArrs
   */
  public function testInsert(array $data) {
    $u = new User($data);
  }

  public function testEquals() {
    $sami1 = (new User())
            ->setEmail("sami.holck@gmail.com");
    $sami2 = (new User())
            ->setEmail("sami.holck@gmail.com");
    $juha = (new User())
            ->setEmail("juha.makila@gmail.com");
    $this->assertTrue($sami1->equals($sami1));
    $this->assertTrue($sami1->equals($sami2));
    $this->assertfalse($sami1->equals($juha));
  }

  /**
   * 
   * @dataProvider existingUsers
   */
  public function testUpdateFails(User $u) {
    $this->assertfalse($u->insertAsNewInto($this->em));
  }

}
