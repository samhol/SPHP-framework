<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms\Inputs\Menus;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Html\Forms\Inputs\Menus\Optgroup;
use Sphp\Html\Forms\Inputs\Menus\Option;

/**
 * Class OptgroupTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class OptgroupTest extends TestCase {

  public function constructorData(): array {
    $data = [];
    $data[] = ['foo'];
    $data[] = [null];
    return $data;
  }

  /**
   * @dataProvider constructorData
   * 
   * @param  string $name
   * @return void
   */
  public function testConstructor(string $name = null): void {
    $obj = new Optgroup($name);
    $this->assertSame($name, $obj->getAttribute('label'));
    $this->assertCount(0, $obj);
    $this->assertTrue($obj->isEnabled());
  }

  /**
   * @return array
   */
  public function optionData(): array {
    $data = [];
    $data[] = ['foo', 'bar'];
    $data[] = [1, 'int'];
    $data[] = [null, 'null'];
    $data[] = ['null', 'null'];
    return $data;
  }

  /**
   * @dataProvider optionData
   * 
   * @param  scalar $value
   * @param  string $content
   * @return void
   */
  public function testAppendOption($value, string $content = null): void {
    $optgroup = new Optgroup('foo');
    $expected = new Option($value, $content);
    $opt = $optgroup->appendOption($value, $content);
    $this->assertCount(1, $optgroup);
    $this->assertEquals($opt, $expected);
  }

  public function testPrepend(): void {
    $optgroup = new Optgroup('foo');
    $b = $optgroup->appendOption('b', 'select b')->setSelected(true);
    $this->assertSame($optgroup, $optgroup->prepend($a = new Option('a', 'select a')));
    $this->assertSame("<optgroup label=\"foo\">" . $a . $b . "</optgroup>", (string) $optgroup);
  }

  /**
   * @return array
   */
  public function arrayData(): array {
    $opts1 = [];
    $opts1['a'] = 'b';
    $opts1['c'] = 'd';
    $data = [];
    $data[] = [$opts1];
    return $data;
  }

  /**
   * @dataProvider arrayData
   * 
   * @param  array $opts
   * @return void
   */
  public function testAppendArray(array $opts): void {
    $optgroup = new Optgroup('foo');
    $optgroup->appendArray($opts);
    $expected = new Optgroup('foo');
    foreach ($opts as $index => $option) {
      $expected->append(new Option($index, (string) $option));
    }

    $this->assertEquals($expected, $optgroup);
    $this->assertCount(count($opts), $optgroup);
    $this->assertContainsOnly(Option::class, $optgroup);
    $this->assertSame(implode('', $optgroup->toArray()), $optgroup->contentToString());
  }
  
  public function testDisable(): void {
    $optgroup = new Optgroup('foo');
    $this->assertTrue($optgroup->isEnabled());
    $opt = $optgroup->appendOption('a', 'b');
    $this->assertSame($optgroup, $optgroup->disable(true));
    $this->assertTrue($opt->isEnabled());
    $this->assertFalse($optgroup->isEnabled());
    $opt->disable(true);
    $this->assertSame($optgroup, $optgroup->disable(false));
    $this->assertTrue($optgroup->isEnabled());
  }

}
