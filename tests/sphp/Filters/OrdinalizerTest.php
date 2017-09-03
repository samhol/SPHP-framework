<?php

namespace Sphp\Filters;

class OrdinalizerTest extends \PHPUnit\Framework\TestCase {

  /**
   *
   * @var Ordinalizer 
   */
  private $ordinalizer;

  /**
   * 
   */
  public function setUp() {
    $this->ordinalizer = new Ordinalizer();
  }

  /**
   * 
   * @return array
   */
  public function testData() {
    $nums = range(4, 20);
    $arr = [];
    foreach ($nums as $num) {
      echo "$num\n";
      $arr[] = [$num, $num . "th"];
      $arr[] = ["$num", $num . "th"];
    }
    $arr[] = ["-2", "-2nd"];
    $arr[] = [1, "1st"];
    $arr[] = ["1", "1st"];
    $arr[] = [2, "2nd"];
    $arr[] = ["2", "2nd"];
    $arr[] = ["3", "3rd"];
    $arr[] = ["103", "103rd"];
    $arr[] = ["103rd", "103rd"];
    $arr[] = ["113", "113th"];
    $arr[] = ["21", "21st"];
    $arr[] = ["1221", "1221st"];
    $arr[] = ["a", "a"];
    $arr[] = ["", ""];
    $arr[] = [false, false];
    $arr[] = [4.2, "4th"];
    $arr[] = [4.6, "4th"];
    return $arr;
  }

  /**
   * @dataProvider testData
   * @covers Sphp\Filters\Ordinalizer::filter
   * @param scalar $string
   * @param string $expected
   */
  public function testOrdinalize($string, $expected) {
    $this->assertEquals($this->ordinalizer->filter($string), $expected);
  }

}
