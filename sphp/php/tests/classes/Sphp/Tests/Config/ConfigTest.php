<?php

declare(strict_types=1);

namespace Sphp\Tests\Config;

use Sphp\Tests\AbstractArrayAccessIteratorCountableTest;
use Sphp\Config\Config;
use Sphp\Config\Exception\ConfigurationException;

class ConfigTest extends AbstractArrayAccessIteratorCountableTest {

  public function constructorParams(): array {
    $params = [];
    $params[] = [[], true];
    $params[] = [['foo' => 'bar'], true];
    $params[] = [['foo' => 'bar'], false];
    $params[] = [['foo' => new \stdClass()], false];
    return $params;
  }

  /**
   * @dataProvider constructorParams
   * 
   * @param array $config
   * @param bool $readOnly
   */
  public function testConstructor(array $config, bool $readOnly) {
    $conf1 = new Config($config, $readOnly);
    $this->assertSame($readOnly, $conf1->isReadOnly());
    $this->assertEquals($config, $conf1->toArray());
    foreach ($config as $name => $value) {
      $this->assertTrue($conf1->contains($name));
      $this->assertSame($value, $conf1->get($name));
      if ($conf1->isReadOnly()) {
        $this->expectException(ConfigurationException::class);
        $conf1->remove($name);
      } else {
        $this->assertSame($conf1, $conf1->remove($name));
        $this->assertFalse($conf1->contains($name));
      }
    }
    $this->expectException(ConfigurationException::class);
    $conf1->get('notset');
  }

  public function testFactorizing(): void {
    $zero = Config::instance();
    $this->assertSame($zero, Config::instance());
    $this->assertSame($zero, Config::instance(''));
    $this->assertSame($zero, Config::instance(null));
    $this->assertFalse($zero->isReadOnly());
    $foo = Config::instance('foo');
    $this->assertSame($foo, Config::instance('foo'));
    $this->assertNotSame($zero, $foo);
    $this->assertFalse($foo->isReadOnly());
  }

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
  public function testArrayInsertion() : void{
    $conf = $this->createCollection();
    $conf['array'] = ['foo' => 'bar'];
    $this->assertInstanceOf(Config::class, $conf['array']);
  }

  public function testLocked(): void {
    $conf = new Config([], false);
    $conf['array'] = ['foo' => 'bar'];
    $this->assertFalse($conf->isReadOnly());
    $conf->setReadOnly();
    $this->assertTrue($conf->isReadOnly());
    $this->assertInstanceOf(Config::class, $conf['array']);
    $this->assertTrue($conf['array']->isReadOnly());
    $this->expectException(ConfigurationException::class);
    $conf->set('foo', 'bar');
  }

  public function testMagicMethods(): void {
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
    $this->expectException(ConfigurationException::class);
    $conf->foo = 'bar';
  }

}
