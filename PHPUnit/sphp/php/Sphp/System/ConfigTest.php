<?php

namespace Sphp\System;

class ConfigTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Config
   */
  protected $dev;

  /**
   * @var Config
   */
  protected $prod;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->dev = Config::obtain("dev");
    $this->prod = Config::obtain("prod");
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  /**
   */
  public function testDefault() {
    $this->assertTrue(Config::obtain()->isDefault());
    $this->assertEquals(Config::obtain()->getDomain(), "dev");
    $this->assertFalse(Config::obtain()->getDomain() == "prod");
    $this->assertFalse(Config::obtain("prod")->isDefault());
    $this->prod->setDefault();
    $this->assertEquals(Config::obtain()->getDomain(), "prod");
    
  }

  /**
   */
  public function testSetting() {
    $this->dev->set("string", "string");
    $this->assertTrue($this->dev->get("string") === "string");
    $this->dev->set("int", 1);
    $this->assertTrue($this->dev->get("int") === 1);
    $this->dev->set("null", null);
    $this->assertTrue($this->dev->get("null") === null);
    $this->dev->set("array", [0, 1, 2]);
    $this->assertTrue($this->dev->get("array") == [0, 1, 2]);
  }

  public function testMerging() {
    $this->prod->set("string", "string1");
    $this->prod->set("int", [0, 1, 2]);
    $this->prod->merge($this->dev);
    $this->assertTrue($this->prod->get("string") === "string1");
    $this->assertTrue($this->prod->get("int") != 1);
    $this->assertEquals($this->prod->get("array"), $this->dev->get("array"));
  }

  public function testUnsetting() {
    $this->dev->remove("string");
    $this->assertFalse($this->dev->exists("string"));
    $this->dev->remove("int");
    $this->assertFalse($this->dev->exists("int"));
  }

}
