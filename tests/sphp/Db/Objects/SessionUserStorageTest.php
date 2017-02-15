<?php

namespace Sphp\Db\Objects;

use Sphp\Core\Config\Config;
use Doctrine\ORM\EntityManagerInterface;
use Sphp\Net\Password;
use Exception;

class SessionUserStorageTest extends \PHPUnit_Framework_TestCase {

  /**
   *
   * @var EntityManagerInterface
   */
  protected $em;

  /**
   *
   * @var SessionUserStorage 
   */
  protected $storage;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->em = Config::instance("manual")
            ->get(EntityManagerInterface::class);
    $this->storage = new SessionUserStorage($this->em); //$this->once();
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
  public function users() {
    $u[] = [(new SessionUser())
                ->setUsername('a')
                ->setEmail('a@gmail.com')
                ->setPassword('pw1')];
    $u[] = [(new SessionUser())
                ->setUsername("johndoe")
                ->setEmail('john.doe@gmail.com')
                ->setPassword('pw1')];
    $u[] = [(new SessionUser())
                ->setUsername("johndoe1")
                ->setEmail('johndoe1@gmail.com')
                ->setPassword('pw1')];
    $u[] = [(new SessionUser())
                ->setUsername("ab")
                ->setEmail('a.b@c.com')
                ->setPassword('pw2')];
    return $u;
  }

  /**
   * @dataProvider users
   *
   * @param UserInterface $u
   */
  public function testClear(UserInterface $u) {
    $this->em->persist($u);
    $this->em->flush();
    $this->assertTrue($this->em->contains($u));
    var_dump($this->storage->count());
    $this->storage->clear();
    var_dump($this->storage->count());
    $this->assertFalse($this->em->contains($u));
  }

  /**
   * @dataProvider users
   * @depends testClear
   */
  public function testInsert(UserInterface $u) {
    $this->assertTrue($this->storage->insertAsNew($u));
    $this->assertTrue($this->storage->contains($this->em));
  }

  /**
   * @dataProvider users
   * @depends testInsert
   *
   * @param UserInterface $u
   */
  public function testExisting(UserInterface $u) {
    $username = $u->getUsername();
    $managed = $this->storage->findByUsername($username);
    $this->assertTrue($managed instanceof UserInterface);
    $this->assertTrue($managed->isManagedBy($this->em));
  }

  /**
   * @dataProvider users
   * @depends testExisting
   */
  public function testEquals() {
    $sami1 = (new SessionUser())
            ->setEmail("sami.holck@gmail.com");
    $sami2 = (new SessionUser())
            ->setEmail("sami.holck@gmail.com");
    $juha = (new SessionUser())
            ->setEmail("juha.makila@gmail.com");
    $this->assertTrue($sami1->equals($sami1));
    $this->assertTrue($sami1->equals($sami2));
    $this->assertfalse($sami1->equals($juha));
  }

  /**
   * @dataProvider users
   * @depends testEquals
   *
   * @param UserInterface $u
   */
  public function testRemovingExisting(UserInterface $u) {
    $username = $u->getUsername();
    $managed = $this->storage->findByUsername($username);
    $this->assertTrue($managed instanceof UserInterface);
    $this->assertTrue($managed->deleteFrom($this->em));
    $this->assertFalse($managed->isManagedBy($this->em));
  }

  /**
   * @dataProvider users
   *
   * @param UserInterface $u
   */
  public function testPasswordSettersAndGetters(UserInterface $u) {
    $pw = new Password("password");
    $u->setPassword($pw);
    $this->assertTrue($u->getPassword()->verify(new Password("password")));
  }

  /**
   * @dataProvider users
   *
   * @param UserInterface $u
   */
  public function testIsManagedBy(SessionUser $u) {
    $this->assertTrue(!$u->isManagedBy($this->em));
    //$this->assertTrue(!$u->setEmail('')->existsIn($this->em));
  }

  /**
   * 
   * @return SessionUser
   */
  public function getFooUser() {
    return (new SessionUser())
                    ->setUsername('foo')
                    ->setEmail('foo@foo.bar')
                    ->setPassword('foo');
  }
}
