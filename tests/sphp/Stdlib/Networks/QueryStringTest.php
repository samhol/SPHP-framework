<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Networks;

class QueryStringTests extends \PHPUnit\Framework\TestCase {

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
  public function arrayData() {
    return [
        [[
        'scheme' => 'http',
        'host' => 'www.whatever.com',
        'user' => 'johndoe',
        'pass' => 'password',
        'path' => 'path/to/file.type',
        'query' => 'q1 = p1&q2 = p2',
        'fragment' => 'daa',
        'port' => 21
            ]],
        [[
        'scheme' => 'https',
        'host' => 'www.whatever.com',
        'user' => '',
        'pass' => 'password',
        'path' => 'path/to/file.type',
        'query' => 'q1 = p1&q2 = p2',
        'fragment' => 'daa',
        'port' => 21
            ]],
    ];
  }

  /**
   * @return mixed[]
   */
  public function params() {
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

}
