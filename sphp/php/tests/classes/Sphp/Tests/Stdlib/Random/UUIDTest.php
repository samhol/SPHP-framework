<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib\Random;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\Random\UUID;
use Sphp\Exceptions\InvalidArgumentException;

class UUIDTest extends TestCase {

  public function testV4AndV5():void {
    for ($i = 0; $i < 50; $i++) {
      $v4 = UUID::v4();
      $this->assertMatchesRegularExpression('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $v4);
      $v5 = UUID::v5($v4, 'foo');
      $this->assertMatchesRegularExpression('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $v5);
      $vCopy = UUID::v5($v4, 'foo');
      $this->assertMatchesRegularExpression('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $vCopy);
      $this->assertEquals($v5, $vCopy);
    }
  }

  public function testV5GenarationFail():void {
    $this->expectException(InvalidArgumentException::class);
    UUID::v5(UUID::v4() . 'foo', 'foo');
  }

}
