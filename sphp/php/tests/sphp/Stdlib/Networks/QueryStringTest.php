<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network;

use Sphp\Tests\ArrayAccessIteratorCountableTestCase;

class QueryStringTests extends ArrayAccessIteratorCountableTestCase {

  /**
   * @return array
   */
  public function equalPairs(): array {
    $pairs[] = ['foo=bar&', ['foo' => 'bar']];
    $pairs[] = ['foo=bar&baz=daa', ['foo' => 'bar', 'baz' => 'daa']];
    $pairs[] = [['f' => 'bar', 'foo' => 'bar'], ['foo' => 'bar', 'f' => 'bar']];
    return $pairs;
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

  public function nameValuePairs(): array {
    $pairs[] = ['foo', 'bar'];
    $pairs[] = [0, 2];
    $pairs[] = ['array', [1, 2, 3]];
    return $pairs;
  }

  /**
   * @dataProvider nameValuePairs
   */
  public function testSetting($key, $value) {
    $q1 = new QueryString();
    $this->assertTrue($q1->isEmpty());
    $q1->set($key, $value);
    $this->assertTrue($q1->contains($key));
    $this->assertSame($value, $q1->get($key));
    $q1->delete($key);
    $this->assertFalse($q1->contains($key));
  }

  /**
   * @return mixed[]
   */
  public function params(): array {
    return [
        [['p2' => 'v2', 'p3' => "<script>alert('hello')</script>"]],
        [['p2' => '', 'p3' => "<script>alert('hello')</script>"]],
        [['<br>' => '', 'p3' => "<script>alert('hello')</script>"]],
    ];
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
      $this->assertTrue($q->contains($key));
      $this->assertSame($q->get($key), $value);
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
    $clone->set('foo', 'bar');
    $this->assertFalse($url->equals($clone));
    $this->assertFalse($url == $clone);
  }

  /**
   */
  public function testToArray() {
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
  public function testJsonFunctionality($queryData) {
    $query = new QueryString($queryData);
    $this->assertEquals(json_encode($query->toArray()), $query->toJson());
    $this->assertEquals(json_encode($query->jsonSerialize()), $query->toJson());
  }

  /**
   * @dataProvider params
   *
   * @param string $queryData
   */
  public function testArrayAccessAndIterator(array $queryData) {
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
    $this->assertEquals('err=%20onmouseover%3D%22alert%28%27foo%27%29', "$object");
    $object['true'] = true;
    $object['false'] = false;
    $object['null'] = null;
  }

}
