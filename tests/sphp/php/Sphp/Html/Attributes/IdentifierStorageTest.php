<?php

namespace Sphp\Html\Attributes;

class IdentifierStorageTest extends \PHPUnit_Framework_TestCase {

  public function configDomain1Data() {
    return [
        ["id", "string", true],
        ["id", "string", false],
        ["", "string", false],
        ["data-id", "string", true],
        ["data-id", "string", false],
        ["data-id", null, false],
        ["data-id", "1", true],
        ["data-id", 1, false],
        ["0", "string", false],
        ["-1", "string", false],
        ["2", "string", false]
    ];
  }

  /**
   * @dataProvider configDomain1Data
   *
   * @param string $name
   * @param mixed $value
   * @param bool $expected
   */
  public function testStoring($name, $value, $expected) {
    $this->assertTrue(HtmlIdStorage::store($name, $value) === $expected);
  }
  
  
  public function existsData() {
    return [
        ["id", "string", true],
        ["id", "string1", false],
        ["", "string", false],
        ["data-id", "string", true],
        ["data-id", null, false],
        ["0", "string", false],
        ["-1", "string", false],
        ["2", "string", false]
    ];
  }

  /**
   * @dataProvider existsData
   *
   * @param string $name
   * @param mixed $value
   * @param bool $expected
   */
  public function testExistence($name, $value, $expected) {
    $this->assertTrue(HtmlIdStorage::exists($name, $value) === $expected);
  }

}
