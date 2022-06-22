<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms\Inputs\Menus;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\Inputs\Menus\AbstractOptionContainer;
use Sphp\Html\Forms\Inputs\Menus\Option;

/**
 * Description of AbstractOptionsContainerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractOptionsContainerTest extends TestCase {

  public function buildContainer(string $tagName = 'option'): AbstractOptionContainer {
    return $this->getMockForAbstractClass(AbstractOptionContainer::class, [$tagName]);
  }

  public function testConstructor(): AbstractOptionContainer {
    $tagName = 'foo';
    $obj = $this->getMockForAbstractClass(AbstractOptionContainer::class, [$tagName]);

    // $this->expectOutputString($Hidden->getHtml());
    //$mock->printHtml();
    if ($obj instanceof AbstractOptionContainer) {
      $this->assertSame($tagName, $obj->getTagName());
    }
    return $obj;
  }

  /**
   * @depends testConstructor
   * 
   * @param  AbstractOptionContainer $obj
   * @return AbstractOptionContainer
   */
  public function testObjectInsertion(AbstractOptionContainer $obj): AbstractOptionContainer {
    $this->assertCount(0, $obj);
    $opt = $obj->appendOption('foo', 'select foo');
    $this->assertInstanceOf(Option::class, $opt);
    $this->assertSame('select foo', $opt->getContent());
    $this->assertSame('foo', $opt->getValue());
    $this->assertCount(1, $obj);
    $opt1 = new Option('bar', 'select bar');
    $this->assertSame($obj, $obj->append($opt1));
    $this->assertCount(2, $obj);
    $opt2 = new Option('foobar', 'select foobar');
    $this->assertSame($obj, $obj->prepend($opt2));
    $this->assertCount(3, $obj);
    return $obj;
  }

  /**
   * @depends testObjectInsertion
   * 
   * @param AbstractOptionContainer $obj
   * @return void
   */
  public function testCloning(AbstractOptionContainer $obj): void {
    $clone = clone $obj;
    $optArr = iterator_to_array($obj, true);
    $this->assertEquals($obj, $clone);
    foreach ($clone as $key => $value) {
      $this->assertNotSame($value, $optArr[$key]);
      $this->assertEquals($value, $optArr[$key]);
    }
  }

}
