<?php

namespace Sphp\Db\Objects;

use Sphp\Core\Configuration as Configuration;
use Doctrine\ORM\EntityManagerInterface as EntityManagerInterface;

class UserTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var User
   */
  protected $u_1;

  /**
   * @var User
   */
  protected $u_2;
  protected $userArr = [
      "username" => "samhol",
      "fname" => "Sami",
      "lname" => "Holck",
      "street" => "Rakuunatie 59 A 3",
      "zipcode" => "20720",
      "city" => "Turku",
      "country" => "Finland"];

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->u_1 = new User();
    $this->u_2 = new User($this->userArr);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  /**
   * 
   * @return array
   */
  public function userData() {
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
   * @return Address
   * @dataProvider userData
   */
  public function addressProvider(array $data) {
    return new Address($data);
  }

  /**
   * 
   * @return EntityManagerInterface
   */
  public function entityManager() {
    return Configuration::useDomain("manual")
                    ->get(EntityManagerInterface::class);
  }

  /**
   * @dataProvider userData
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
   * @dataProvider userData
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
    public function testSetting() {
    $this->u_1->setStreet("Rakuunatie 59 A 3");
    $this->assertTrue($this->u_1->getStreet() === "Rakuunatie 59 A 3");
    }
   */
}
