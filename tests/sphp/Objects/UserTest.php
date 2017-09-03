<?php

namespace Sphp\Objects;

class UserTest extends \PHPUnit\Framework\TestCase {

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
    $this->u_1 =new User();
    $this->u_2 = new User($this->userArr);
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  /**
   */
  public function testEquals() {
    $this->assertTrue(!$this->u_1->equals($this->u_2));
    $this->assertTrue($this->u_1 != $this->u_2);
    $this->u_1->setStreet("Rakuunatie 59 A 3");
    $this->assertTrue($this->u_1 == $this->u_2);
    $this->assertTrue($this->u_1->equals($this->u_2));
    
  }

  /**
   */
  public function testSetting() {
    $this->u_1->setStreet("Rakuunatie 59 A 3");
    $this->assertTrue($this->u_1->getStreet() === "Rakuunatie 59 A 3");
  }

}
