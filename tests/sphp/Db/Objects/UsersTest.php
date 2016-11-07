<?php

namespace Sphp\Db\Objects;

use Sphp\Core\Configuration;
use Doctrine\ORM\EntityManagerInterface;

class UsersTest extends \PHPUnit_Framework_TestCase {

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
    //var_dump($this->users);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
   /* $type = $this->users->getObjectType();
    echo "\nDeleteing all $type\n";
    $batchSize = 20;
    $i = 0;
    $q = $this->em->createQuery("select u from $type u");
    $iterableResult = $q->iterate();
    while (($row = $iterableResult->next()) !== false) {
      $this->em->remove($row[0]);
      if (($i % $batchSize) === 0) {
        $this->em->flush(); // Executes all deletions.
        $this->em->clear(); // Detaches all objects from Doctrine!
      }
      ++$i;
    }
    $this->em->flush();*/
  }
  /**
   * 
   * @param int $expected
   */
  public function testCount($expected = 0) {
    //$this->assertTrue($this->users->save($expected));
    var_dump($this->users->count());
    $this->assertGreaterThanOrEqual($expected, $this->users->count());
  }
 /**
   * 
   * @return array
   */
  public function users() {
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
   * @param User $expected
   */
  public function testInsert(User $expected = null) {
    $this->testCount(0);
    $this->assertTrue($this->users->save((new User())
            ->setUsername("samhol")
            ->setEmail("sami.holck@gmail.com")
            ->setFname("sami")
            ->setLname("holck")));    
    $this->testCount(1);
    var_dump($this->users->count());
    $this->assertGreaterThanOrEqual($expected, $this->users->count());
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
  public function atestInsert(array $data) {
    $u = new User($data);
    $this->assertTrue($u->insertInto($this->em));
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
   // $this->assertfalse($u->insertInto($this->em));
  }

}
