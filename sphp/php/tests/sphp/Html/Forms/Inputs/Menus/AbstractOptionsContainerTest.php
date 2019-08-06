<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use PHPUnit\Framework\TestCase;

/**
 * Description of AbstractOptionsContainerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractOptionsContainerTest extends TestCase {

  public function buildContainer(): AbstractOptionsContainer {
    return $this->getMockForAbstractClass(AbstractOptionsContainer::class, ['foo']);
  }

  public function testConstructor(): AbstractOptionsContainer {
    $obj = $this->getMockForAbstractClass(AbstractOptionsContainer::class, ['foo']);

    // $this->expectOutputString($Hidden->getHtml());
    //$mock->printHtml();
    if ($obj instanceof AbstractOptionsContainer) {
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
            'array' => [range('a', 'c')]
        ]
    ];
    return $data;
  }

  /**
   * @dataProvider insertionData
   * @param array $options
   */
  public function testArrayAppending($options) {
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

    $optGroup = $obj->appendOptgroup('foo', range('a', 'c'));
    $this->assertInstanceOf(Optgroup::class, $optGroup);
    return $obj;
  }

}
