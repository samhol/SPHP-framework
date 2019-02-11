<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\InvalidArgumentException;

class ErrormessageTest extends TestCase {

  public function simpleDataSet(): array {
    return array(
        0 => 'foo',
        'zero' => 'foobar',
        'one' => '',
        'two' => 'good job',
    );
  }

  public function testAppending() {
    $cont = new ErrorMessages();
    foreach ($this->simpleDataSet() as $id => $val) {
      $this->assertSame($cont, $cont->setTemplate($id, $val));
      $this->assertSame($val, $cont->getTemplate($id));
      $this->assertSame($cont, $cont->appendErrorFromTemplate($id));
    }
    return $cont;
  }

  /**
   * @depends testAppending
   * @param ErrorMessages $em
   */
  public function testCloning(ErrorMessages $cont) {
    $clone = clone $cont;
    $this->assertNotSame($cont, $clone);
    return $cont;
  }

  /**
   * @depends testCloning
   * @param ErrorMessages $em
   */
  public function testClearing(ErrorMessages $em) {
    $this->assertSame($em, $em->setEmpty());
    $this->assertCount(0, $em);
  }

  /**
   */
  public function testMerging() {
    $cont = new ErrorMessages();
    $this->assertSame($cont, $cont->mergeCollection($this->simpleDataSet()));
    foreach ($cont as $val) {
      $this->assertTrue(in_array($val, $this->simpleDataSet()));
    }
    $cont->setEmpty();
    $cont->mergeCollection(new \Zend\Stdlib\ArrayObject($this->simpleDataSet()));
    foreach ($cont as $val) {
      $this->assertTrue(in_array($val, $this->simpleDataSet()));
    }
  }

  /**
   * @return array
   */
  public function invalidMergeContent(): array {
    return [
        [new \stdClass()],
        [null],
        [false],
        [true],
        [1],
        ['string'],
    ];
  }

  /**
   * @dataProvider invalidMergeContent
   */
  public function testInvalidMerging($mergedData) {
    $cont = new ErrorMessages();
    $this->expectException(InvalidArgumentException::class);
    $this->assertSame($cont, $cont->mergeCollection($mergedData));
  }

  public function testArrayAccessAndIterator() {
    $cont = new ErrorMessages();
    $items = array(
        0 => 'foo',
        'zero' => 'foobar',
        'one' => '',
        'two' => 'good job',
        'array' => ['a', 'b' => 'c']
    );
    $count = count($items);
    foreach ($items as $offset => $message) {
      $cont->offsetSet($offset, $message);
      if (!is_array($message)) {
        $this->assertTrue(isset($cont[$offset]));
      } else {
        $this->assertEquals($message, $cont[$offset]->toArray());
      }
    }
    $this->assertCount($count, $cont);
    // both cycles must pass
    for ($n = 0; $n < 2; ++$n) {
      $i = 0;
      reset($items);
      foreach ($cont as $key => $val) {
        if ($i >= $count) {
          $this->fail("Iterator overflow!");
        }
        $this->assertEquals(key($items), $key);
        //$this->assertEquals(current($items), $val);
        next($items);
        ++$i;
      }
      $this->assertEquals($count, $i);
    }
    foreach ($cont as $key => $value) {
      unset($cont[$key]);
      $this->assertFalse(isset($cont[$key]));
      $this->assertNull($cont[$key]);
    }
  }

  /**
   * @return array
   */
  public function invalidContent(): array {
    return [
        [new \stdClass()],
        [null],
        [false],
        [true],
        [1],
    ];
  }

  /**
   * @dataProvider invalidContent
   * @param mixed $invalidValue
   */
  public function testInvalidInsertion($invalidValue) {
    $cont = new ErrorMessages();
    $this->expectException(InvalidArgumentException::class);
    $cont['foo'] = $invalidValue;
  }

  public function testAppendingNonExsistentTemplate() {
    $cont = new ErrorMessages();
    $cont->setTemplate('foo', 'bar');
    $this->expectException(InvalidArgumentException::class);
    $cont->appendErrorFromTemplate('bar');
  }

  public function testNesting() {
    $errors = new ErrorMessages();
    $errors['nest'] = new ErrorMessages();
    $errors['nest']['foo'] = 'Foo is wrong';
    $this->assertEquals('Foo is wrong', $errors['nest']['foo']);
    return $errors;
  }

  /**
   * @depends testNesting
   * @param \Sphp\Validators\ErrorMessages $errors
   */
  public function testToArray(ErrorMessages $errors) {
    $array = $errors->toArray();
    foreach ($array as $key => $val) {
      $this->assertTrue(is_string($val) || is_array($val));
    }
    $this->assertEquals('Foo is wrong', $errors['nest']['foo']);
  }

  /**
   */
  public function testUsageCase() {
    $errors = new ErrorMessages();
    $errors['foo'] = 'Foo is wrong';
    $errors->setTemplate('bar', 'A bar with %s and %s is wrong');
    $this->assertCount(1, $errors);
    $this->assertEquals('Foo is wrong', $errors['foo']);
    $errors->appendErrorFromTemplate('bar', ['foo', 'foobar']);
    $this->assertCount(2, $errors);
    $this->assertEquals('A bar with foo and foobar is wrong', $errors[0]);
    $this->assertSame($errors, $errors->append('Foo is still wrong'));
    $this->assertCount(3, $errors);
    $this->assertEquals('Foo is still wrong', $errors[1]);
  }

  /**
   */
  public function testFromTraversable() {
    $empty = ErrorMessages::fromTraversable([]);
    $this->assertCount(0, $empty);
    $one = ErrorMessages::fromTraversable(['Foo is wrong']);
    $this->assertCount(1, $one);
    $it = ErrorMessages::fromTraversable(new \ArrayIterator(['Foo is wrong']));
    $this->assertCount(1, $it);
  }

}
