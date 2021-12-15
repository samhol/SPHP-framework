<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Lists;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Lists\Dl;
use Sphp\Html\Lists\Dt;
use Sphp\Html\Lists\Dd;

class DlTest extends TestCase {

  /**
   * @return Dl
   */
  public function testConstructor(): Dl {
    $dl = new Dl();
    $this->assertNull($dl->getItem(0));
    $this->assertStringStartsWith('<dl', "$dl");
    $this->assertStringEndsWith('</dl>', "$dl");
    $this->assertCount(0, $dl);
    return $dl;
  }

  /**
   * @depends testConstructor
   * 
   * @param  Dl $dl
   * @return Dl
   */
  public function testAppend(Dl $dl): Dl {
    $term = new Dt('term');
    $dd1 = new Dd('description');
    $this->assertSame($dl, $dl->append($term));
    $this->assertSame($term, $dl->getItem(0));
    $this->assertSame($dl, $dl->append($dd1));
    $this->assertSame($dd1, $dl->getItem(1));
    return $dl;
  }

  /**
   * @depends testAppend
   * 
   * @param  Dl $dl
   * @return Dl
   */
  public function testAppendTerm(Dl $dl): Dl {
    $term = $dl->appendTerm('created term');
    $this->assertEquals(new Dt('created term'), $term);
    $this->assertSame($term, $dl->getItem($dl->count() - 1));
    $desc2 = $dl->appendDescription('created description');
    return $dl;
  }

  /**
   * @depends testAppend
   * 
   * @param  Dl $dl
   * @return Dl
   */
  public function testAppendDefinition(Dl $dl): Dl {
    $desc = $dl->appendDescription('created description');
    $this->assertEquals(new Dd('created description'), $desc);
    $this->assertSame($desc, $dl->getItem($dl->count() - 1));
    return $dl;
  }

  /**
   * @depends testAppendDefinition
   * 
   * @param  Dl $dl
   * @return Dl
   */
  public function testAppendDefinitions(Dl $dl): Dl {
    $this->assertSame($dl, $dl->appendDescriptions(['foo', 'bar']));
    $this->assertEquals(new Dd('foo'), $dl->getItem($dl->count() - 2));
    $this->assertEquals(new Dd('bar'), $dl->getItem($dl->count() - 1));
    return $dl;
  }

  /**
   * @depends testAppend
   * 
   * @param Dl $dl
   */
  public function testPrepend(Dl $dl) {
    $pre = $dl->count();
    $dl->prepend($dd = new Dd('foo'));
    $this->assertSame($dd, $dl->getItem(0));
    $this->assertCount($pre + 1, $dl);
  }

  /**
   * @depends testAppend
   * 
   * @param Dl $original
   */
  public function testClone(Dl $original) {
    $clone = clone $original;
    foreach ($original as $key => $item) {
      $this->assertEquals($item, $clone->getItem($key));
      $this->assertNotSame($item, $clone->getItem($key));
    }
    $this->assertEquals($clone, $original);
  }

}
