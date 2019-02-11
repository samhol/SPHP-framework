<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Random;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\InvalidArgumentException;

class UUIDTest extends TestCase {

  public function testV4AndV5() {
    for ($i = 0; $i < 50; $i++) {
      $v4 = UUID::v4();
      $this->assertRegExp('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $v4);
      $v5 = UUID::v5($v4, 'foo');
      $this->assertRegExp('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $v5);
      $vCopy = UUID::v5($v4, 'foo');
      $this->assertRegExp('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $vCopy);
      $this->assertEquals($v5, $vCopy);
    }
  }

  public function testV5GenarationFail() {
    $this->expectException(InvalidArgumentException::class);
    UUID::v5(UUID::v4() . 'foo', 'foo');
  }

}
