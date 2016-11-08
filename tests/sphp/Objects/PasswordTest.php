<?php

namespace Sphp\Net;

class PasswordTest extends \PHPUnit_Framework_TestCase {

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    
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
  public function passwords() {
    $u[] = ["password"];
    $u[] = ["a"];
    $u[] = [""];
    $u[] = ["$56722_@12"];
    return $u;
  }

  /**
   * @dataProvider passwords
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
