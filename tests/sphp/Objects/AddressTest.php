<?php

namespace Sphp\Objects;

class AddressTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Address
   */
  protected $addr_1;

  /**
   * @var Address
   */
  protected $addr_2;
  
  protected $addrArr = [
      "street" => "Rakuunatie 59 A 3",
      "zipcode" => "20720",
      "city" => "Turku",
      "country" => "Finland"];

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->addr_1 =new Address();
    $this->addr_2 = new Address($this->addrArr);
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
    $this->assertTrue(!$this->addr_1->equals($this->addr_2));
    $this->assertTrue($this->addr_1 != $this->addr_2);
    $this->addr_1->setStreet("Rakuunatie 59 A 3");
    $this->assertTrue($this->addr_1 == $this->addr_2);
    $this->assertTrue($this->addr_1->equals($this->addr_2));
    
  }

  /**
   */
  public function testSetting() {
    $this->addr_1->setStreet("Rakuunatie 59 A 3");
    $this->assertTrue($this->addr_1->getStreet() === "Rakuunatie 59 A 3");
  }

}
