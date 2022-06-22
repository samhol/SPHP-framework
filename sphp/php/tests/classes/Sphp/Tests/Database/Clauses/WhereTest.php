<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Database\Clauses;

use PHPUnit\Framework\TestCase;
use Sphp\Database\Predicates;
use Sphp\Database\Clauses\Where;

/**
 * The WhereTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WhereTest extends TestCase {

  public function testEmptyConstructor(): void {
    $where = new Where();
    $this->assertFalse($where->notEmpty());
    $this->assertCount(0, $where);
    $this->assertSame('', "$where");
  }

  public function testAndThese(): Where {
    $where = new Where();
    $ands = $where->andThese('foo = 1 OR foo = 2');
    $this->assertTrue($where->notEmpty());
    $ors = $where->orThese('bar = 4 AND bar = 25')->andEquals('doo', 'daa');
    $this->assertTrue($where->notEmpty());
    //$this->assertCount(2, $where);
    $this->assertSame("WHERE ($ands) OR ($ors)", "$where");
    return $where;
  }

  /**
   * @depends testAndThese
   * 
   * @param Where $where
   * @return void
   */
  public function testClone(Where $where): void {
    $clone = clone $where;
    $this->assertEquals($where, $clone);
    $this->assertNotSame($where->getRuleSet(), $clone->getRuleSet());
  }

}
