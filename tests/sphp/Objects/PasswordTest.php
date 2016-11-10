<?php

namespace Sphp\Net;

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
    $password = new Password($pw);
    $this->assertTrue($password->verify($pw));
    $hash = new HashedPassword(password_hash($pw, PASSWORD_DEFAULT));
    $this->assertTrue($hash->verify($pw));
    $this->assertTrue($hash->verify($password));
    $this->assertFalse($password->verify($fault));
    $this->assertFalse($hash->verify($fault));
  }

}
