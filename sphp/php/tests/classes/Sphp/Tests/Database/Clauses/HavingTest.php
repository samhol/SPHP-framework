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
use Sphp\Database\Clauses\Having;
use Sphp\Database\Predicates;
use Sphp\Database\Predicates\PredicateSet;
use Sphp\Database\Predicates\Equals;
use Sphp\Database\Exceptions\BadMethodCallException;
/**
 * The HavingTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HavingTest extends TestCase {
    public function testEmptyConstructor(): Having {
    $having = new Having();
    $this->assertFalse($having->notEmpty());
    $params = $having->getParams();
    $this->assertCount(0, $params);
    $this->assertCount(0, $having);
    $this->assertSame('', "$having");
    return $having;
  }

  public function testNotEmpty(): void {
    $having = new Having();
    $ands = $having->andThese('SUM(col)1 > 0', 'COUNT(col2) < 2');
    $this->assertTrue($having->notEmpty());
    $ors = $having->orThese('SUM(col)1 > 10', 'COUNT(col2) < 20');
    $this->assertTrue($having->notEmpty());
    $this->assertCount(0, $having->getParams());
    //echo  "$having";
    $this->assertSame("HAVING ($ands) OR ($ors)", "$having");
  }
}
