<?php

namespace Sphp\Config;

use Sphp\Tests\AbstractArrayAccessIteratorCountableTest;
use Sphp\Exceptions\RuntimeException;
class ConfigTest extends AbstractArrayAccessIteratorCountableTest {

  public function configData1(): array {
    return [
        [["domain1" => ["string" => "string"]], true],
        [["domain1" => ["int" => 1]], true],
        [["domain1" => ["bool" => false]], true],
        [["domain1" => ["array" => ["first" => 1, 2, 3]]], true],
        [["domain1" => ["obj" => new \stdClass()]], true]
    ];
  }

  /**
   * @dataProvider configData1
   *
   * @param array $config
   * @param string $locked
   */
  public function testVariableSetting(array $config, $locked) {
    $conf = new Config($config, $locked);
    if (!$locked) {
      $conf->foo = ['bar' => 'foobar'];
      $this->assertEquals($conf->foo->bar, 'foobar');
      $this->assertFalse($conf->isReadOnly(), 'foobar');
      $conf->foo->a = 'bar';
      $this->assertEquals($conf->foo->a, 'bar');
    } else {
      $this->assertTrue($conf->isReadOnly());
    }
    $this->assertSame($config, $conf->toArray());
  }

  public function mergeData(): array {
    return [
        [['foo' => 'bar'], ['foo' => 'baz']],
        [['foo' => 'bar'], ['foo' => 'baz', 'f' => 2]],
    ];
  }

  /**
   * @dataProvider mergeData
   *
   * @param array $data1
   * @param array $data2
   */
  public function testMerging(array $data1, array $data2) {
    $conf1 = new Config($data1, false);
    $conf2 = new Config($data2, false);
    $conf1->merge($conf2);
    foreach ($data2 as $varName => $value) {
      $this->assertSame($conf1[$varName], $value);
      $this->assertSame($conf1->get($varName), $value);
      $this->assertSame($conf1->$varName, $value);
      $this->assertTrue($conf1->contains($varName));
    }
  }

  public function arrayData(): array {
    $array['string'] = 'string';
    $array['true'] = true;
    $array['false'] = false;
    $array['int'] = 1;
    $array['float'] = 1.1;
    $array['object'] = new \stdClass();
    return $array;
  }

  public function createCollection(): \ArrayAccess {
    return new Config([], false);
  }

  /**
   */
  public function testArrayInsertion() {
    $conf = $this->createCollection();
    $conf['array'] = ['foo' => 'bar'];
    $this->assertInstanceOf(Config::class, $conf['array']);
  }

  public function testLocked() {
    $conf = new Config([], false);
    $conf['array'] = ['foo' => 'bar'];
    $this->assertFalse($conf->isReadOnly());
    $conf->setReadOnly();
    $this->assertTrue($conf->isReadOnly());
    $this->assertInstanceOf(Config::class, $conf['array']);
    $this->assertTrue($conf['array']->isReadOnly());
    $this->expectException(RuntimeException::class);
    $conf->set('foo', 'bar');
  }

  public function testMagicMethods() {
    $conf = new Config([], false);
    $this->assertFalse(isset($conf->array));
    $conf->array = ['foo' => 'bar'];
    $this->assertTrue(isset($conf->array));
    $conf->foobar = 'bar of foo';
    $this->assertTrue(isset($conf->foobar));
    unset($conf->foobar);
    $this->assertFalse(isset($conf->foobar));
    $conf->setReadOnly();
    $this->assertTrue(isset($conf->array->foo));
    $this->assertSame('bar', $conf->array->foo);
    $this->expectException(RuntimeException::class);
    $conf->foo = 'bar';
  }

}
