<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;

class TagsTest extends TestCase {

  public function testFactoring() {
    foreach (Tags::getTagMap() as $call => $objectType) {
      //echo "\ncall: $call";
      $this->assertInstanceOf($objectType, Tags::create($call));
      $this->assertInstanceOf($objectType, Tags::$call());
      $str = Tags::create($call);
      $this->assertTrue(\Sphp\Stdlib\Strings::contains("$str", '<' . $str->getTagName()));
    }
  }

  public function testInvalidCreateMethodCall() {
    $this->expectException(InvalidArgumentException::class);
    Tags::create('foo');
  }

  public function testInvalidMagicCall() {
    $this->expectException(BadMethodCallException::class);
    Tags::foo('foo');
  }

}
