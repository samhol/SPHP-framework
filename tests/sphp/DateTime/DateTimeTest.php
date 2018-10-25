<?php

namespace Sphp\Tests\DateTime;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\DateTime;

class DateTimeTest extends TestCase {


  public function testConstructor() {
    $timestamp = time();
    $now = new DateTime('2018-01-01 12:00');
    $now1 = new DateTime('2018-01-01 12:00');
    $this->assertEquals($now, $now1);
  }

}
