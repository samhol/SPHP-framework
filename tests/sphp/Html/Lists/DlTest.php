<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Lists;

use PHPUnit\Framework\TestCase;

class DlTest extends TestCase {

  /**
   * @return Dl
   */
  public function testConstructor(): Dl {
    $dl = new Dl();
    $this->assertStringStartsWith('<dl', "$dl");
    $this->assertStringEndsWith('</dl>', "$dl");
    $this->assertCount(0, $dl);
    return $dl;
  }

  /**
   * @depends testConstructor
   * 
   * @param Dl $dl
   */
  public function testAppending(Dl $dl): Dl {
    $term = new Dt('term');
    $dd1 = new Dd('description');
    $this->assertInstanceOf(Dl::class, $dl->append($term));
    $this->assertTrue($dl->contains($term));
    $this->assertInstanceOf(Dl::class, $dl->append($dd1));
    $this->assertTrue($dl->contains($dd1));
    $term2 = $dl->appendTerm('created term');
    $this->assertTrue($dl->contains($term2));
    $desc2 = $dl->appendDescription('created description');
    $this->assertTrue($dl->contains($desc2));
    return $dl;
  }

  /**
   * @depends testConstructor
   * 
   * @param Dl $dl
   */
  public function testPrepending(Dl $dl) {
    $dl->prepend($dd = new Dd('foo'));
    $this->assertTrue($dl->contains($dd));
  }

}
