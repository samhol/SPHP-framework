<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use PHPUnit\Framework\TestCase;

/**
 * Description of LineNumbererTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LineNumbererTest extends TestCase {

  public function constructorParameters(): array {
    return [
        [1, 'Row '],
        [3, '*']
    ];
  }

  /**
   * @dataProvider constructorParameters
   * @return LineNumberer
   */
  public function testConstructor(int $start, string $label): LineNumberer {
    $numberer = new LineNumberer($start, $label);
    $this->assertSame($start, $numberer->getStart());
    $this->assertSame($label, $numberer->getLabel());
    return $numberer;
  }

  /**
   * @depends testConstructor
   */
  public function testOptionSetting() {
    $numberer = new LineNumberer();
    $this->assertSame($numberer, $numberer->setFirstLineNumber(10));
    $this->assertSame(10, $numberer->getFirstLineNumber());
    $this->assertSame($numberer, $numberer->setLabel('¤'));
    $this->assertSame('¤', $numberer->getLabel());
  }
  
  public function getTable() {
    
  }
  /**
   * @depends testConstructor
   */
  public function testTableManipulation() {
    
    $numberer = new LineNumberer();
    $this->assertSame($numberer, $numberer->setFirstLineNumber(10));
    $this->assertSame(10, $numberer->getFirstLineNumber());
    $this->assertSame($numberer, $numberer->setLabel('¤'));
    $this->assertSame('¤', $numberer->getLabel());
  }

}
