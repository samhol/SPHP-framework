<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Bootstrap\Layout;

use PHPUnit\Framework\TestCase;
use Sphp\Bootstrap\Layout\Container;
use Sphp\Bootstrap\Exceptions\BootstrapException;
use Sphp\Bootstrap\Layout\Spacer;
use Sphp\Html\Div;

/**
 * The SpacerTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SpacerTest extends TestCase {

  /**
   * @return void
   */
  public function testCase1(): void {
    $spacer = new Spacer();
    $spacer->useSpacings('my-md-4', 'my-md-auto', 'm-md-auto', 'mx-md-5');
    $spacer->useSpacings('m-3', 'm-lg-3', 'p-4');
    // $this->assertCount($spacer->hasCssClass('col'));
    //print_r($spacer->toArray());
    $this->assertCount(6, $spacer->toArray());
    $div = new Div;
    $spacer->insertInto($div);
    foreach ($spacer as $spacing) {
      $this->assertTrue($div->hasCssClass($spacing));
    }
  }

  /**
   * @return void
   */
  public function testCase2(): void {
    $spacer = new Spacer();
    $spacer->useSpacings('m-3');
    $this->assertCount(1, $spacer->toArray());
    $div = new Div;
    $div->addCssClass('m-auto');
    $spacer->insertInto($div);
    $this->assertFalse($div->hasCssClass('m-auto'));
    $this->assertTrue($div->hasCssClass('m-3'));
  }

  public function invalidSpacings(): array {
    $err = [];
    $err[] = ['m-13'];
    $err[] = ['p-13'];
    $err[] = ['p-foo'];
    $err[] = ['p'];
    return $err;
  }

  /**
   * @dataProvider invalidSpacings
   * 
   * @param  string $spacing
   * @return void
   */
  public function testInvalid(string $spacing): void {
    $this->expectException(BootstrapException::class);
    $spacer = new Spacer();
    $spacer->useSpacings($spacing);
  }

  public function testConflictingSpacers() {
    $spacer = new Spacer();
    $spacer->useSpacings('m-1');
    $div = new Div;
    $div->addCssClass('m-auto');
    $spacer->insertInto($div);
    $this->assertFalse($div->hasCssClass('m-auto'));
    $this->assertTrue($div->hasCssClass('m-1'));
  }

  /**
   * @return array<ont, string|int>
   */
  public function breakpoints(): array {
    $ints[] = 'sm';
    $ints[] = 'lg';
    $ints[] = 'md';
    $ints[] = 'xl';
    return $ints;
  }

  public function allSpacings() {
    $vals = range(0, 5);
    $vals[] = 'auto';
    $breakpoints[] = '-sm-';
    $breakpoints[] = '-lg-';
    $breakpoints[] = '-md-';
    $breakpoints[] = '-xl-';
    $breakpoints[] = '-';
    $sides[] = 't';
    $sides[] = 'b';
    $sides[] = 'l';
    $sides[] = 'r';
    $sides[] = 'x';
    $sides[] = 'y';
    $sides[] = '';
    foreach (['m', 'p'] as $v1) {
 
      foreach ($sides as $v2) {
 
        foreach ($breakpoints as $v3) {
 
          foreach ($vals as $v4) { 
            $outs[] = "$v1$v2$v3$v4";
          }
        }
      }
    }
    return $outs;
  }

  public function testInterfaces(): void {
   // print_r($this->allSpacings());
    $spacer = new Spacer();
    $spacer->useSpacings('m-1', 'mt-1');
    $div = new Div;
    $div->addCssClass('m-auto');
    $spacer->insertInto($div);
    $this->assertFalse($div->hasCssClass('m-auto'));
    $this->assertTrue($div->hasCssClass('m-1'));
  }

}
