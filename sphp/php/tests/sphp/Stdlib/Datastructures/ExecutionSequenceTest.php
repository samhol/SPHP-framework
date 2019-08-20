<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use PHPUnit\Framework\TestCase;

/**
 * Implementation of ExecutionSequenceTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ExecutionSequenceTest extends TestCase {

  /**
   * 
   * @return ExecutionSequence
   */
  public function testConstructor(): ExecutionSequence {
    $sequence = new ExecutionSequence();
    $this->assertCount(0, $sequence);
    $this->assertCount(0, $sequence->toArray());
    return $sequence;
  }

  /**
   * @depends testConstructor
   * @param ExecutionSequence $sequence
   */
  public function testCallables(ExecutionSequence $sequence) {
    $f1 = function() {
      $val = 'ce';
      echo $val;
      return $val;
    };
    $f10_1 = function() {
      $val = 'se';
      echo $val;
      return $val;
    };
    $f10_2 = function() {
      $val = 'quen';
      echo $val;
      return $val;
    };
    $this->assertSame($sequence, $sequence->addCallable($f10_1, 10));
    $this->assertCount(1, $sequence);
    $this->assertSame($sequence, $sequence->addCallable($f1, 1));
    $this->assertCount(2, $sequence);
    $this->assertContains($f1, $sequence);
    $this->assertContains($f1, $sequence->getIterator());
    $this->assertContains($f1, $sequence->toArray());
    $this->assertSame($sequence, $sequence->addCallable($f10_2, 10));
    $this->expectOutputString('sequence');
    $this->assertCount(3, $sequence);
    $sequence();
    $this->assertSame($sequence, $sequence->flushSequence());
    $this->assertCount(0, $sequence);
    unset($sequence);
  }

}
