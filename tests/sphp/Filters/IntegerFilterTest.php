<?php

namespace Sphp\Filters;

class IntegerFilterTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var IntegerFilter
   */
  protected $filter;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->filter = new IntegerFilter();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    
  }

  /**
   * 
   * @return real
   */
  public function testData() {
    $arr = [];
    $arr[] = [null, 'not int'];
    $arr[] = [false, 'not int'];
    $arr[] = [[], 'not int'];
    $arr[] = [[1], 'not int'];
    $arr[] = [new \stdClass(), 'not int'];
    $arr[] = ['a', 'not int'];
    $arr[] = ['', 'not int'];
    $arr[] = [' ', 'not int'];
    $arr[] = [' 1 ', 'not int'];
    $arr[] = ['\t0 ', 'not int'];
    $arr[] = ['-2', -2];
    $arr[] = [4.2, 4];
    $arr[] = [4.9, 5];
    $arr[] = [0b1, 1];
    $arr[] = [0b10, 2];
    $arr[] = ['0b10', 'not int'];
    $arr[] = [-0xa, -0xa];
    $arr[] = [3e4, (int)3e4];
    $arr[] = [0, 0];
    $arr[] = ['0.9', 1];
    $arr[] = [5, 5];
    $arr[] = [-5, -5];
    return $arr;
  }

  /**
   * 
   * @dataProvider testData
   */
  public function testValues($raw, $exp) {
    $f = new IntegerFilter();
    $f->setDefault('not int');
    $this->assertSame($f($raw), $exp);
    $this->assertSame($f->filter($raw), $exp);
  }


}

class IntEx {
    function __toString()
    {
        return '3'; // you must return a string
    }
}