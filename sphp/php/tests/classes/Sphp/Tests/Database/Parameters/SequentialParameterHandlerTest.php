<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Database\Parameters;

use PHPUnit\Framework\TestCase;
use Sphp\Database\Parameters\SequentialParameterHandler;
use Sphp\Database\Parameters\Parameter;

/**
 * The SequentialParameterTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SequentialParameterHandlerTest extends TestCase {

  public function testAppendNewParams(): SequentialParameterHandler {
    $handler = new SequentialParameterHandler();
    $handler->appendNewParams('foo', null);
    $arr = iterator_to_array($handler);
    $this->assertArrayNotHasKey(0, $arr);
    $this->assertEquals(new Parameter('foo', null), $arr[1]);
    return $handler;
  }

  /**
   * @depends testAppendNewParams
   * 
   * @param SequentialParameterHandler $handler
   */
  public function testClone(SequentialParameterHandler $handler) {
    $clone = clone $handler;
    $cloneArray = iterator_to_array($clone);
    $this->assertArrayNotHasKey(0, $cloneArray);
    foreach ($handler as $key => $value) {
      $this->assertNotSame($cloneArray[$key], $value);
      $this->assertEquals($cloneArray[$key], $value);
    }
  }

}
