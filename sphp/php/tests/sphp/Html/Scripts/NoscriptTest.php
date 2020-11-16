<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Head;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Scripts\Noscript;
use Sphp\Html\Div;

/**
 * Class NoscriptTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class NoscriptTest extends TestCase {

  /**
   * @return void
   */
  public function testEmptyConstructor(): void {
    $noscript1 = new Noscript();
    $noscript2 = new Noscript();
    $this->assertSame("<noscript></noscript>", (string) $noscript1);
    $this->assertNotEquals($noscript1->getHash(), $noscript2->getHash());
  }

  /**
   * @return array
   */
  public function constructorData(): array {
    $data = [];
    $data[] = ['foo'];
    $data[] = [2];
    $data[] = [false];
    $data[] = [new Div('foo')];
    return $data;
  }

  /**
   * @dataProvider constructorData
   * 
   * @param  mixed $content
   * @return void
   */
  public function testConstructor($content): void {
    $noscript1 = new Noscript($content);
    $noscript2 = new Noscript($content);
    $this->assertSame("<noscript>$content</noscript>", (string) $noscript1);
    $this->assertNotEquals($noscript1->getHash(), $noscript2->getHash());
  }

}
