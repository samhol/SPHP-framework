<?php

namespace Sphp\Db\Objects;

use Sphp\Db\EntityManagerFactory;
use Doctrine\ORM\EntityManagerInterface;
use Sphp\Core\Security\Password;
use Sphp\Core\Types\Permissions;
use Exception;

class SessionUserTest extends \PHPUnit_Framework_TestCase {

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
    $this->em = EntityManagerFactory::get();
    $this->storage = new SessionUserStorage();
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
                ->setPlainPassword('pw1')];
    $u[] = [(new SessionUser())
                ->setUsername("johndoe")
                ->setEmail('john.doe@gmail.com')
                ->setPlainPassword('pw1')];
    $u[] = [(new SessionUser())
                ->setUsername("johndoe1")
                ->setEmail('johndoe1@gmail.com')
                ->setPlainPassword('pw1')];
    $u[] = [(new SessionUser())
                ->setUsername("ab")
                ->setEmail('a.b@c.com')
                ->setPlainPassword('pw2')];
    return $u;
  }

  /**
   * @dataProvider users
   *
   * @param UserInterface $u
   */
  public function testClear(UserInterface $u) {
    $this->storage->clear();
    if (!$this->storage->contains($u)) {
      $this->storage->insertAsNew($u);
    }
    $this->assertTrue($this->storage->contains($u));
    var_dump($this->storage->count());
    $this->storage->clear();
    var_dump($this->storage->count());
    $this->assertFalse($this->em->contains($u));
    var_dump($length = ceil(log10(PHP_INT_MAX)));
  }

  /**
   * @dataProvider users
   * @depends testClear
   */
  public function testInsert(UserInterface $u) {
    $u->insertAsNewInto($this->em);
    $this->assertTrue($u->isManagedBy($this->em));
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
    // $this->assertTrue($managed->isManagedBy($this->em));
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
  public function testIsManagedBy(SessionUser $u) {
    $this->assertTrue(!$u->isManagedBy($this->em));
    //$this->assertTrue(!$u->setEmail('')->existsIn($this->em));
  }

  /**
   * @dataProvider users
   *
   * @param UserInterface $u
   */
  public function testSettingAndGetting(UserInterface $u) {
    $u->setUsername('foo');
    $this->assertSame($u->getUsername(), 'foo');
    $u->setEmail('foo@foo.bar');
    $this->assertSame($u->getEmail(), 'foo@foo.bar');
    $permissions = new Permissions(0b0011101);
    $u->setPermissions($permissions);
    $this->assertTrue($u->getPermissions()->contains(0b0011101));
    $password = Password::fromPassword('password');
    $u->setPassword($password);
    $this->assertTrue($u->getPassword()->verify('password'));
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
