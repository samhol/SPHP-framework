<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Network;

use PHPUnit\Framework\TestCase;
use Sphp\Network\QueryString;

/**
 * @testdox QueryString tests
 */
class QueryStringTest extends TestCase {

  public function testEmpty(): void {
    $query = new QueryString();
    $this->assertTrue($query->isEmpty());
    $this->assertCount(0, $query->toArray());
  }

  public function constructorData(): iterable {
    yield [null];
    yield ['foo=bar&'];
    $arr = ['foo' => 'bar'];
    yield [$arr];
    $obj = (object) $arr;
    yield [$obj];
    yield [new \ArrayIterator($arr)];
  }

  /**
   * @dataProvider constructorData
   * 
   * @param  mixed $data
   * @return void
   */
  public function testConstructorAndMerging($data): void {
    $query1 = new QueryString($data);
    $query2 = new QueryString();
    $query2->merge($data);
    $this->assertEquals($query2, $query1);
  }

  /**
   * @return array
   */
  public function equalPairs(): iterable {
    yield ['foo=bar&', ['foo' => 'bar']];
    yield ['foo=bar&baz=daa', ['foo' => 'bar', 'baz' => 'daa']];
    yield [['f' => 'bar', 'foo' => 'bar'], ['foo' => 'bar', 'f' => 'bar']];
  }

  /**
   * @dataProvider equalPairs
   * @param string $urlString
   */
  public function testEquals($q1, $q2) {
    $query1 = new QueryString($q1);
    $query2 = new QueryString($q2);
    $this->assertTrue($query1->equals($query2));
    $this->assertTrue($query2->equals($query1));
    $this->assertTrue($query2->equals($q1));
    $this->assertTrue($query2->equals($q2));
  }

  public function arrayAccessDAta(): iterable {
    yield [1, 'bar'];
    yield [0.1, 2];
    yield [0, [1, 2, 3]];
    yield ['foo', [1, 2, 3]];
  }

  /**
   * @dataProvider arrayAccessDAta
   * 
   * @param  scalar $key
   * @param  scalar $value
   * @return void
   */
  public function testArrayAccess($key, $value): void {
    $query = new QueryString();
    $this->assertNull($query[$key]);
    $this->assertNull($query[(string) $key]);
    $query[$key] = $value;
    $this->assertTrue(isset($query[$key]));
    $this->assertTrue(isset($query[(string) $key]));
    $this->assertSame($value, $query[$key]);
    $this->assertSame($value, $query[(string) $key]);
    unset($query[$key]);
    $this->assertNull($query[$key]);
    $this->assertNull($query[(string) $key]);
    $this->assertFalse(isset($query[$key]));
    $this->assertFalse(isset($query[(string) $key]));
  }

  public function numericParameterNames(): iterable {
    yield [1, 'bar'];
    yield [0.1, 2];
    yield [0, [1, 2, 3]];
  }

  /**
   * @dataProvider numericParameterNames
   * 
   * @param  mixed $key
   * @param  mixed $value
   * @return void
   */
  public function testNumericParameterNames($key, $value): void {
    $stringKey = (string) $key;
    $query1 = new QueryString();
    $query2 = new QueryString();
    $this->assertFalse($query1->hasParameter($stringKey));
    $this->assertSame($query1, $query1->setParameter($stringKey, $value));
    $query2[$key] = $value;
    $this->assertEquals($query1, $query2);
    $this->assertTrue($query1->hasParameter($stringKey));
    $this->assertTrue(isset($query1[$key]));
    $this->assertTrue($query2->hasParameter($stringKey));
    $this->assertSame($value, $query1[$stringKey]);
    $query1->removeParameter($stringKey);
    $this->assertFalse($query1->hasParameter($stringKey));
    //echo "{$query2->build(10)}\n";
  }

  public function params(): iterable {
    yield [['p2' => 'v2', 'p3' => "<script>alert('hello')</script>"]];
    yield [['p2' => '', 'p3' => "<script>alert('hello')</script>"]];
    yield [['<br>' => '', 'p3' => "<script>alert('hello')</script>"]];
  }

  /**
   * @dataProvider params
   * @param string $urlString
   */
  public function testSetParams(array $urlString) {
    $q = new QueryString();
    $this->assertTrue($q->isEmpty());
    $q->merge($urlString);
    $this->assertSame($q->toArray(), $urlString);
    foreach ($urlString as $key => $value) {
      $this->assertTrue($q->hasParameter($key));
      $this->assertSame($value, $q->getParameter($key));
    }
  }

  /**
   * @dataProvider params
   * @param string $urlString
   */
  public function testClone(array $urlString) {
    $url = new QueryString($urlString);
    $clone = clone $url;
    $this->assertTrue($url->equals($clone));
    $this->assertTrue($url == $clone);
    $clone->setParameter('foo', 'bar');
    $this->assertFalse($url->equals($clone));
    $this->assertFalse($url == $clone);
  }

  public function testToArray(): void {
    $query = new QueryString('a=b&c[1]=1&c[2]=2');
    $urlArray = $query->toArray();
    $this->assertEquals($urlArray['a'], $query['a']);
  }

  public function queries(): array {
    return [
        [['p2' => 'v2', 'p3' => "<script>alert('hello')</script>"]],
        ['a=b&ampc=d'],
        [new \ArrayIterator(['a' => 'b'])],
    ];
  }

  /**
   * @dataProvider queries
   *
   * @param string $queryData
   */
  public function testJsonFunctionality($queryData): void {
    $query = new QueryString($queryData);
    $this->assertEquals(json_encode($query->toArray()), $query->toJson());
    $this->assertEquals(json_encode($query->jsonSerialize()), $query->toJson());
  }

  /**
   * @dataProvider params
   *
   * @param string $queryData
   */
  public function testArrayAccessAndIterator(array $queryData): void {
    $object = new QueryString($queryData);
    foreach ($queryData as $key => $value) {
      $this->assertTrue(isset($object[$key]));
      $this->assertEquals($value, $object[$key]);
    }
    $this->assertFalse(isset($object['five']));
    $this->assertCount(count($queryData), $object);
    // both cycles must pass
    for ($n = 0; $n < 2; ++$n) {
      $i = 0;
      reset($queryData);
      foreach ($object as $key => $val) {
        if ($i >= 6) {
          $this->fail("Iterator overflow!");
        }
        $this->assertEquals(key($queryData), $key);
        $this->assertEquals(current($queryData), $val);
        next($queryData);
        ++$i;
      }
      $this->assertEquals(count($queryData), $i);
    }
  }

  public function testInvalidParams() {
    $object = new QueryString();
    $object['err'] = " onmouseover=\"alert('foo')";
    $this->assertEquals('err=+onmouseover%3D%22alert%28%27foo%27%29', "$object");
    $object['true'] = true;
    $object['false'] = false;
    $object['null'] = null;
  }

  public function urlStrings(): iterable {
    yield ['?arg=value'];
    yield ['http://username:password@hostname:9090/path?arg=value#anchor'];
  }

  /**
   * @dataProvider urlStrings
   * 
   * @param  string $url
   * @return void
   */
  public function testCreateFromURLString(string $url): void {
    $object = QueryString::fromURL($url);
    $this->assertEquals('arg=value', "$object");
  }

  public function testOutput(): void {
    $obj = new class() {

      public function __toString(): string {
        return 'foofar';
      }
    };
    $object = new QueryString($data = [
        'foo' => 'b a r',
        'arr' => range(1, 3),
        'object' => $obj]);
    $this->assertSame(http_build_query($data, '', '&', \PHP_QUERY_RFC1738), $object->build(\PHP_QUERY_RFC1738));
    $this->assertSame(http_build_query($data, '', '&', \PHP_QUERY_RFC3986), $object->build(\PHP_QUERY_RFC3986));
    $this->assertSame(http_build_query($data, '', '&', \PHP_QUERY_RFC1738), $object->toRFC1738());
    $this->assertSame(http_build_query($data, '', '&', \PHP_QUERY_RFC3986), $object->toRFC3986());
    $object->setSeparator('&amp;');
    $this->assertSame(http_build_query($data, '', '&amp;', \PHP_QUERY_RFC1738), $object->build(\PHP_QUERY_RFC1738));
    $this->assertSame(http_build_query($data, '', '&amp;', \PHP_QUERY_RFC3986), $object->build(\PHP_QUERY_RFC3986));
    $this->assertSame(http_build_query($data, '', '&amp;', \PHP_QUERY_RFC1738), $object->toRFC1738());
    $this->assertSame(http_build_query($data, '', '&amp;', \PHP_QUERY_RFC3986), $object->toRFC3986());
  }

  public function testOutputs() {
    $object = new QueryString($data = [
        'foo' => '',
        'bar' => ''
    ]);
    $fromFirst = new QueryString($object->build(\PHP_QUERY_RFC1738));
    $this->assertEquals($fromFirst, $object);
  }

}
