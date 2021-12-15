<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Head;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Head\Head;
use Sphp\Html\Head\Base;

class HeadTest extends TestCase {

  public function testConstructor(): void {
    $head = new Head();
    $this->assertSame("<head></head>", "$head");
    $head1 = new Head('title', 'utf-8');
    $this->assertCount(2, $head1);
  }

  public function testBaseAddress(): void {
    $head = new Head();
    $base = $head->meta()->setBaseAddress('http://foo.bar', '_blank');
    $base1 = new Base('http://foo.bar', '_blank');
    $this->assertTrue($base1 == $base);
    $this->assertCount(1, $head->meta());
  }

}
