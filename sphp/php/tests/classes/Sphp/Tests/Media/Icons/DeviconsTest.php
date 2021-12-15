<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Media\Icons;

use PHPUnit\Framework\TestCase;
use Sphp\Media\Icons\Devicons; 

/**
 * Description of DeviconsTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DeviconsTest extends TestCase {

  /**
   * @return Devicons
   */
  public function testInvoking(): Devicons {
    $factory = new Devicons();
    $icon = $factory('devicon-github-plain');
    $i = $icon->createTag();
    $this->assertTrue($i->hasCssClass('devicon-github-plain'));
    $this->assertSame('i', $i->getTagName());
    return $factory;
  }
  /**
   * @depends testInvoking
   * @param   Devicons $factory
   */
  public function testSetColored(Devicons $factory) { 
    $this->assertFalse($factory('devicon-github-plain')->createTag()->hasCssClass('colored'));
    $this->assertSame($factory, $factory->setColored(true));
    $this->assertTrue($factory('devicon-github-plain')->createTag()->hasCssClass('colored'));
  }

  /**
   * @depends testInvoking
   * @param   Devicons $icon
   */
  public function testClone(Devicons $icon) {
    $cloned = clone $icon;
    $this->assertNotSame($icon, $cloned);
    $this->assertEquals($icon('fas fa-tree'), $cloned('fas fa-tree'));
  }

}
