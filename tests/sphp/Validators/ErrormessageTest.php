<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Validators;

use PHPUnit\Framework\TestCase;

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
   */
  public function testMerging() {
    $cont = new ErrorMessages();
    $this->assertSame($cont, $cont->mergeArray($this->simpleDataSet()));
    foreach ($cont as $val) {
      $this->assertTrue(in_array($val, $this->simpleDataSet()));
    }
  }

  public function testArrayAccessAndIterator() {
    $cont = new ErrorMessages();
    $items = array(
        0 => 'foo',
        'zero' => 'foobar',
        'one' => '',
        'two' => 'good job',
    );
    $count = count($items);
    foreach ($items as $offset => $message) {
      $cont->offsetSet($offset, $message);
      $this->assertTrue(isset($cont[$offset]));
      $this->assertSame($message, $cont[$offset]);
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
        $this->assertEquals(current($items), $val);
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
        [['array']]
    ];
  }

  /**
   * @expectedException \Sphp\Exceptions\InvalidArgumentException
   * @dataProvider invalidContent
   * @param mixed $invalidValue
   */
  public function testInvalidInsertion($invalidValue) {
    $cont = new ErrorMessages();
    $cont['foo'] = $invalidValue;
  }

  /**
   * @expectedException \Sphp\Exceptions\InvalidArgumentException
   */
  public function testAppendingNonExsistentTemplate() {
    $cont = new ErrorMessages();
    $cont->setTemplate('foo', 'bar');
    $cont->appendErrorFromTemplate('bar');
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
  }

}
