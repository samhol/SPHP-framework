<?php

namespace Sphp\Core\Security;

class PasswordTest extends \PHPUnit_Framework_TestCase {

  /**
   * 
   * @return array
   */
  public function plainPasswords() {
    $u[] = ["password"];
    $u[] = ["a"];
    $u[] = ["0"];
    $u[] = ["$56722_@12"];
    return $u;
  }

  /**
   * @dataProvider plainPasswords
   * @param string $pw
   */
  public function testVerification($pw) {
    $fault = "fault";
    $password = Password::fromPassword($pw);
    $hash = Password::fromHash($password->getHash());
    $this->assertTrue($password->verify($pw));
    $this->assertTrue($hash->verify($pw));
    $this->assertFalse($password->verify($fault));
    $this->assertFalse($hash->verify($fault));
  }

}
