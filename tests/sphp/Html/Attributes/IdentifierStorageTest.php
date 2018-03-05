<?php

namespace Sphp\Html\Attributes;

class IdentifierStorageTest extends \PHPUnit\Framework\TestCase {

  public function storeData(): array {
    return [
        ['id', 'a'],
        ['id', 'b'],
        ['data-id', 'a'],
        ['data-id', 'b'],
        ['', 'a'],
        ['', 'b']
    ];
  }

  /**
   * @dataProvider storeData
   *
   * @param string $name
   * @param string $value
   */
  public function testStoring(string $name, string $value) {
    $storage = IdStorage::get($name);
    $this->assertFalse($storage->contains($value));
    $this->assertTrue($storage->store($value));
    $this->assertTrue($storage->contains($value));
    $this->assertFalse($storage->store($value));
    $this->assertTrue($storage->contains($value));
  }

  public function existsData(): array {
    return [
        ["id", "b", false],
        ["id", "a", true],
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

    public function testExistence(string $name, string $value, bool $expected) {
    $storage = IdStorage::get($name);
    $this->assertSame($expected, $storage->contains($value));
    } */
}
