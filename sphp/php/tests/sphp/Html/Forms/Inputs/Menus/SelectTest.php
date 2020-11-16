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
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Html\Forms\Inputs\Menus\MenuComponent;
use Sphp\Html\Forms\Inputs\Menus\Optgroup;
use Sphp\Html\Forms\Inputs\Menus\Option;

/**
 * Implements tests for Select menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SelectTest extends TestCase {

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
    $obj = new Select($name);
    $this->assertSame($name, $obj->getName());
    $this->assertCount(0, $obj);
    $this->assertTrue($obj->isEnabled());
    $this->assertFalse($obj->isRequired());
    if ($name !== null) {
      $this->assertTrue($obj->isNamed());
    } else {
      $this->assertFalse($obj->isNamed());
    }
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
    $select = new Select('foo');
    $expected = new Option($value, $content);
    $opt = $select->appendOption($value, $content);
    $this->assertCount(1, $select);
    $this->assertEquals($opt, $expected);
  }

  public function testPrepend(): void {
    $select = new Select('foo');
    $b = $select->appendOption('b', 'select b')->setSelected(true);
    $this->assertSame($select, $select->prepend($a = new Option('a', 'select a')));
    $this->assertSame("<select name=\"foo\">$a$b</select>", (string) $select);
    $this->assertSame($select, $select->prepend($group = new Optgroup('group')));
    $g = $group->appendOption('g', 'select g');
    $this->assertSame("<select name=\"foo\">$group$a$b</select>", (string) $select);
  }

  /**
   * @return array
   */
  public function optionArrayData(): array {

    $data = [];
    $data[] = [[$optData]];
    return $data;
  }

  /**
   * 
   * @param  array $opts
   * @return void
   */
  public function testAppendOptGroup(): void {
    $optgoup = new Optgroup('group');
    $optgoup->appendOption('a', 'b');
    $optgoup->appendOption('b', 'c');
    $select = new Select('foo');
    $select->append($optgoup);
    $expected = new Select('foo');
    $group = $expected->appendOptgroup('group');
    $group->appendOption('a', 'b');
    $group->appendOption('b', 'c');
    $this->assertEquals($group, $optgoup);

    $this->assertEquals($expected, $select);
    $this->assertCount(2, $select);
    $this->assertContainsOnly(Option::class, $select->getOptions());
  }

  /**
   * @return array
   */
  public function arrayData(): array {
    $opts1 = [];
    $opts1['foo'] = 'bar';
    $opts1['group1'] = range('a', 'd');
    $opts1['foo'] = 'bar';
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
    $select = new Select('foo');
    $select->appendArray($opts);
    $expected = new Select('foo');
    foreach ($opts as $index => $option) {
      if (is_array($option)) {
        $optGroup = new Optgroup((string) $index);
        $optGroup->appendArray($option);
        $expected->append($optGroup);
      } else {
        $expected->append(new Option($index, (string) $option));
      }
    }

    $this->assertEquals($expected, $select);
    $this->assertCount(count($select->getOptions()), $select);
    $this->assertContainsOnly(Option::class, $select->getOptions());
    $this->assertSame(implode('', $select->toArray()), $select->contentToString());
  }

  public function testSubmission(): void {
    $select = new Select('foo');
    $this->assertSame([], $select->getSubmitValue());
    $a = $select->appendOption('a', 'select a');
    $b = $select->appendOption('b', 'select b');
    $b->setSelected(true);
    $this->assertTrue($b->isSelected());
    $this->assertSame($select, $select->setInitialValue('a'));
    $this->assertSame(['a'], $select->getSubmitValue());
    $this->assertTrue($a->isSelected());
    $this->assertFalse($b->isSelected());
  }

  public function testSelectedDisabled(): void {
    $select = new Select('foo');
    $this->assertSame([], $select->getSubmitValue());
    $select->appendOption('a', 'select a')->disable(true);
    $select->appendOption('b', 'select b');
    $this->assertSame($select, $select->setInitialValue('a'));
    $this->assertSame([], $select->getSubmitValue());
  }

  public function testMultipleSelectedWhileMultipleNotAllowed(): void {
    $select = new Select('foo');
    $this->assertSame([], $select->getSubmitValue());
    $select->appendOption('a', 'select a')->setSelected(true);
    $select->appendOption('b', 'select b')->setSelected(true);
    $select->appendOption('c', 'select c');
    $this->assertSame($select, $select->setInitialValue(['a', 'b']));
    $this->assertSame(['b'], $select->getSubmitValue());
  }

  public function testDisabling(): void {
    $select = new Select('foo');
    $this->assertTrue($select->isEnabled());
    $opt = $select->appendOption('a', 'b');
    $optgroup = $select->appendOptgroup('a', range('a', 'c'));
    $this->assertSame($select, $select->disable(true));
    $this->assertTrue($opt->isEnabled());
    $this->assertFalse($select->isEnabled());
    $opt->disable(true);
    $this->assertSame($select, $select->disable(false));
    $this->assertTrue($select->isEnabled());
  }

  public function testSetSize(): void {
    $select = new Select('foo');
    $this->assertTrue($select->isEnabled());
    $select->appendOption('a', 'b');
     $select->appendOptgroup('a', range('a', 'c'));
    $this->assertSame($select, $select->setSize(4));
    $this->assertSame(4, $select->attributes()->getValue('size'));
  }

  public function testRequiring(): void {
    $select = new Select('foo');
    $this->assertFalse($select->isRequired());
    $this->assertFalse($select->attributes()->isVisible('required'));
    $select->appendOption('a', 'b');
    $optgroup = $select->appendOptgroup('a', range('a', 'c'));
    $this->assertSame($select, $select->setRequired(true));
    $this->assertTrue($select->attributes()->isVisible('required'));
    $this->assertTrue($select->isRequired());
    $this->assertSame($select, $select->setRequired(false));
    $this->assertFalse($select->attributes()->isVisible('required'));
    $this->assertFalse($select->isRequired());
  }

}
