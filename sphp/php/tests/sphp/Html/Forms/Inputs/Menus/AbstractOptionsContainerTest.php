<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
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

  public function buildContainer(): AbstractOptionContainer {
    return $this->getMockForAbstractClass(AbstractOptionContainer::class, ['foo']);
  }

  public function testConstructor(): AbstractOptionContainer {
    $obj = $this->getMockForAbstractClass(AbstractOptionContainer::class, ['foo']);

    // $this->expectOutputString($Hidden->getHtml());
    //$mock->printHtml();
    if ($obj instanceof AbstractOptionContainer) {
      $this->assertSame('foo', $obj->getTagName());
    }
    return $obj;
  }

  public function insertionData(): array {
    $data = [];
    $data[] = [range('a', 'c')];
    $data[] = [
        [
            Option::class => new Option('foo', 'select foo'),
            'a' => 'b'
        ]
    ];
    return $data;
  }

  /**
   * @dataProvider insertionData
   * @param array $options
   */
  public function testArrayAppending($options): void {
    $obj = $this->buildContainer();
    $this->assertCount(0, $obj);
    $obj->appendArray($options);
    $this->assertCount(count($options), $obj);
  }

  /**
   * @param array $options
   */
  public function testObjectInsertion() {
    $obj = $this->buildContainer();
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

}
