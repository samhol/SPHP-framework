<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\PropertyCollectionAttribute;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\NullPointerException;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Stdlib\Arrays;

class PropertyCollectionAttributeTest extends TestCase {

  /**
   * @var PropertyCollectionAttribute 
   */
  protected $attr;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->attr = new PropertyCollectionAttribute('prop');
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->attr = null;
  }

  protected function hasNoValues(PropertyCollectionAttribute $attr) {
    $this->assertTrue($attr->isEmpty());
    $this->assertFalse($attr->isProtected());
    $this->assertCount(0, $attr);
    $this->assertSame(0, $this->attr->count());
  }

  /**
   * @param array $props
   */
  public function testConstructor() {
    $attr = new PropertyCollectionAttribute('style');
    $this->hasNoValues($attr);
    $this->assertFalse($attr->isDemanded());
    $this->assertFalse($attr->isVisible());
    $this->expectException(BadMethodCallException::class);
    $attr->__construct('foo');
  }

  /**
   * @return array[]
   */
  public function invalidProperties(): array {
    return [
        [['p' => '']],
        [['' => 'v']],
        ['p;'],
        ['p1:;p2;'],
        [':v'],
        ['p:'],
    ];
  }

  /**
   * @dataProvider invalidProperties
   * @param string|array $props
   */
  public function testInvalidSetting($props) {
    $this->expectException(InvalidArgumentException::class);
    $this->attr->set($props);
  }

  /**
   * @return array[]
   */
  public function validProperties(): array {
    return [
        [['p1' => 'v1', 'p2' => 'v2']],
        ['p1:v1;p2:v2;'],
        [';p2:v2;p1:v1;'],
    ];
  }

  /**
   * @return array[]
   */
  public function props(): array {
    return [
        [['a' => 'b', 'c' => 'd', 'e' => 'f']]
    ];
  }

  /**
   * @dataProvider props
   * @param array $props
   */
  public function testSet(array $props) {
    $string = Arrays::implodeWithKeys($props, ';', ':');
    $this->attr->set($string);
    $this->assertSame($string, $this->attr->getValue());
    $this->assertTrue($this->attr->hasProperty('a'));
    $this->assertSame('b', $this->attr->getProperty('a'));
    $this->assertTrue($props == $this->attr->toArray());
    $this->assertCount(count($props), $this->attr);
    $this->assertSame(count($props), $this->attr->count());
    foreach ($this->attr as $key => $val) {
      $this->assertTrue(in_array($val, $props));
      $this->assertTrue(array_key_exists($key, $props));
    }
    $this->attr->clear();
    $this->hasNoValues($this->attr);
    /* $iteratorMock = $this->getMockBuilder(PropertyCollectionAttribute::class)
      ->disableOriginalConstructor()
      ->setMethods(array('rewind', 'valid', 'current', 'key', 'next'))
      ->getMock();
      $this->mockIterator($this->attr, $props, true); */
  }

  /**
   * @param string|array $props
   */
  public function testArrayAccess() {
    $this->attr['foo'] = 'bar';
    $this->attr['baz'] = 'foobar';
    $this->assertTrue(isset($this->attr['foo']));
    $this->assertSame('bar', $this->attr['foo']);
    unset($this->attr['foo']);
    $this->assertFalse(isset($this->attr['foo']));
    $this->assertTrue(isset($this->attr['baz']));
    $this->assertSame('foobar', $this->attr['baz']);
    $this->assertFalse(isset($this->attr['foobar']));
    $this->expectException(NullPointerException::class);
    $this->attr['foobar'];
  }

  /**
   * @dataProvideer props
   * @param array $props
   */
  public function testSingleProperty() {
    $this->attr->setProperty('a', 'b');
    $this->assertTrue($this->attr->hasProperty('a'));
    $this->assertSame('b', $this->attr->getProperty('a'));
    $this->attr->unsetProperty('a');
    $this->assertFalse($this->attr->hasProperty('a'));
    $this->attr->lockProperty('a', 'b');
    $this->assertTrue($this->attr->hasProperty('a'));
    $this->assertTrue($this->attr->isProtected('a'));
    $this->expectException(\Sphp\Html\Attributes\Exceptions\ImmutableAttributeException::class);
    $this->assertFalse($this->attr->setProperty('a', 'foo'));
  }

  /**
   * @dataProvider props
   * @param array $props
   */
  public function testProtecting(array $props) {
    $string = Arrays::implodeWithKeys($props, ';', ':');
    $this->attr->lockProperties($props);
    $this->assertTrue($this->attr->hasProperty('a'));
    $this->assertSame('b', $this->attr->getProperty('a'));
    try {
      $this->expectException(\Sphp\Html\Attributes\Exceptions\ImmutableAttributeException::class);
      $this->attr->unsetProperty('a');
    } catch (\Exception $ex) {

      $this->expectException(\Sphp\Html\Attributes\Exceptions\ImmutableAttributeException::class);
      $this->assertFalse($this->attr->lockProperty('a', 'foo'));
    }

    $this->expectException(\Sphp\Html\Attributes\Exceptions\ImmutableAttributeException::class);
    $this->assertFalse($this->attr->setProperty('a', 'foo'));
  }

  /**
   * @param array $props
   */
  public function testOutput() {
    $this->assertSame('', $this->attr->getHtml());
    $this->attr->setProperty('a', 'b');
    $this->assertSame($this->attr->getName() . '="a:b"', $this->attr->getHtml());
  }

  /**
   * Mock iterator
   *
   * This attaches all the required expectations in the right order so that
   * our iterator will act like an iterator!
   * source from: http://www.davegardner.me.uk/blog/2011/03/04/mocking-iterator-with-phpunit/
   *
   * @author: dave@mpdconsulting.co.uk
   * @param Iterator $iterator The iterator object; this is what we attach
   *      all the expectations to
   * @param array An array of items that we will mock up, we will use the
   *      keys (if needed) and values of this array to return
   * @param boolean $includeCallsToKey Whether we want to mock up the calls
   *      to "key"; only needed if you are doing foreach ($foo as $k => $v)
   *      as opposed to foreach ($foo as $v)
   */
  private function mockIterator(Iterator $iterator, array $items, $includeCallsToKey = FALSE
  ) {
    $iterator->expects($this->at(0))
            ->method('rewind');
    $counter = 1;
    foreach ($items as $k => $v) {
      $iterator->expects($this->at($counter++))
              ->method('valid')
              ->will($this->returnValue(TRUE));
      $iterator->expects($this->at($counter++))
              ->method('current')
              ->will($this->returnValue($v));
      if ($includeCallsToKey) {
        $iterator->expects($this->at($counter++))
                ->method('key')
                ->will($this->returnValue($k));
      }
      $iterator->expects($this->at($counter++))
              ->method('next');
    }
    $iterator->expects($this->at($counter))
            ->method('valid')
            ->will($this->returnValue(FALSE));
  }

}
