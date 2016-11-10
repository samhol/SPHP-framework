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
  public function users() {
    $u[] = [(new LoginUser())
                ->setUsername("samhol")
                ->setEmail("sami.holck@gmail.com")
                ->setPassword("pw1")];
    $u[] = [(new LoginUser())
                ->setUsername("johndoe")
                ->setEmail("john.doe@gmail.com")
                ->setPassword("pw1")];
    $u[] = [(new LoginUser())
                ->setUsername("ab")
                ->setEmail("a.b@c.com")
                ->setPassword("pw2")];
    return $u;
  }

  /**
   * @dataProvider users
   */
  public function testPasswordSettersAndGetters(UserInterface $u) {
    $pw = new Password("password");
    $u->setPassword($pw);
    $this->assertTrue($u->getPassword()->verify(new Password("password")));
  }

  /**
   * @dataProvider users
   */
  public function testIsManagedBy(LoginUser $u) {
    $this->assertTrue(!$u->isManagedBy($this->em));
    //$this->assertTrue(!$u->setEmail('')->existsIn($this->em));
  }

  /**
   * @dataProvider users
   */
  public function testInsert(LoginUser $u) {
    //$u->insertInto($this->em);
    if (!$this->em->contains($u)) {
      $this->em->persist($u);
      $this->em->flush();
    }
    $this->assertTrue($this->em->contains($u));
    // $this->assertTrue($u->insertInto($this->em));
  }

  /**
   * @depends testInsert
   * @dataProvider users
   */
  public function atestDelete(LoginUser $user) {
    $managedUser = $this->em->getRepository(LoginUser::class)->findOneBy(array('email' => $user->getEmail()));
    $this->em->remove($managedUser);
    $this->em->flush();
    //$this->assertTrue($u->deleteFrom($this->em));
  }

  /**
   * 
   */
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
