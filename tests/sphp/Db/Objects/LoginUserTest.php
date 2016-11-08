<?php

namespace Sphp\Db\Objects;

use Sphp\Core\Configuration;
use Doctrine\ORM\EntityManagerInterface;
use Sphp\Net\Password;

class LoginUserTest extends \PHPUnit_Framework_TestCase {

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
  public function users() {
    $u[] = (new LoginUser())
            ->setUsername("samhol")
            ->setEmail("sami.holck@gmail.com");
    
    $u[] = (new LoginUser())
            ->setUsername("johndoe")
            ->setEmail("john.doe@gmail.com");
    $u[] = (new LoginUser())
            ->setUsername("ab")
            ->setEmail("a.b@c.com");
    return [$u];
  }


  /**
   * @dataProvider users
   */
  public function testPasswordSettersAndGetters(UserInterface $u) {
    $pw = new Password("password");
    $u->setPassword($pw);
    $this->assertTrue($u->getPassword()->equals(new Password("password")));
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

}
