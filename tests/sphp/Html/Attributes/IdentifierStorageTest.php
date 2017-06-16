<?php

namespace Sphp\Html\Attributes;

class IdentifierStorageTest extends \PHPUnit_Framework_TestCase {

  public function storeData(): array {
    return [
        ['id', 'string', true],
        ['id', 'string', false],
        ['a', 'string', true],
        ["data-id", 'string', true],
        ["data-id", 'string', false],
        ["data-id", '', false],
        ['data-id', '1', true],
        ['data-id', ' ', false],
        ['0', 'string', false],
        ['-1', 'string', false],
        ['2', 'string', false]
    ];
  }

  /**
   * @dataProvider storeData
   *
   * @param string $name
   * @param string $value
   * @param bool $expected
   */
  public function testStoring(string $name, string $value, bool $expected) {
    $storage = IdStorage::get($name);
    $this->assertTrue($storage->store($value) === $expected);
  }

  public function existsData(): array {
    return [
        ["id", "string", true],
        ["id", "string1", false],
        ["", "string", false],
        ["data-id", "string", true],
        ["data-id", '', false],
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
  public function testExistence(string $name, string $value, bool $expected) {
    $storage = IdStorage::get($name);
    $this->assertTrue($storage->contains($name, $value) === $expected);
  }

}
