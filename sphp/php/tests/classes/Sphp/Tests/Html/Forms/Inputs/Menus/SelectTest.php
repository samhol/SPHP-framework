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

  public function testEmptyConstructor(): Select {
    $select = new Select();
    $this->assertNull($select->getName());
    $this->assertFalse($select->isNamed());
    $this->assertTrue($select->isEnabled());
    $this->assertCount(0, $select);
    return $select;
  }

  /**
   * @depends testEmptyConstructor
   * 
   * @param  Select $select
   * @return Select
   */
  public function testAttributeSettings(Select $select): Select {
    $this->assertSame($select, $select->setName('menu'));
    $this->assertTrue($select->isNamed());
    $this->assertFalse($select->attributeExists('multiple'));
    $this->assertSame($select, $select->selectMultiple(true));
    $this->assertTrue($select->attributeExists('multiple'));
    $this->assertSame($select, $select->selectMultiple(false));
    $this->assertFalse($select->attributeExists('multiple'));
    return $select;
  }

  public function constructorData(): iterable {
    $opt = new Option('baz', 'zap');
    yield ['foo', ['foo' => 'bar']];
    yield [null, ['foo' => 'bar']];
    yield [null, ['foo' => 'bar', $opt]];
  }

  /**
   * @dataProvider constructorData
   * 
   * @param  string|null $name
   * @param  iterable|null $opts
   * @return void
   */
  public function testConstructorWithParams(?string $name, ?array $opts): void {
    $obj = new Select($name, new \ArrayIterator($opts));
    $obj1 = new Select($name, $opts);
    $obj1->setName($name);
    $this->assertEquals($obj1->getName(), $obj->getName());
    $this->assertSame($name, $obj->getName());
    $this->assertCount(count($opts), $obj);
    $this->assertTrue($obj->isEnabled());
    $this->assertFalse($obj->isRequired());
    $this->assertSame($name !== null, $obj->isNamed());
    $this->assertEquals($obj->toArray(), $obj1->toArray());
  }

  public function optionData(): iterable {
    yield ['foo', 'bar'];
    yield [1, 'int'];
    yield [null, 'null'];
  }

  /**
   * @dataProvider optionData
   * 
   * @param  scalar|null $value
   * @param  string|null $content
   * @return void
   */
  public function testAppendNewOption($value, ?string $content = null): void {
    $select = new Select('foo');
    $expected = new Option($value, $content);
    $opt = $select->appendOption($value, $content);
    $this->assertCount(1, $select);
    $this->assertEquals($opt, $expected);
  }

  /**
   * @depends testAttributeSettings
   * 
   * @param  Select $select
   * @return Select
   */
  public function testAppending(Select $select): Select {
    $opt1 = $select->appendOption('foo', 'FOO');
    $select->append($opt2 = new Option('bar', 'BAR'));
    $this->assertCount(2, $select);
    $this->assertEqualsCanonicalizing([$opt1, $opt2], iterator_to_array($select));
    $select->append($group1 = new Optgroup('label', []));
    $this->assertCount(2, $select);
    $group1->appendOption('baz', 'BAZ');
    $this->assertCount(3, $select);
    return $select;
  }

  /**
   * @depends testAppending
   * 
   * @param  Select $select
   * @return void
   */
  public function testPrepending(Select $select): void {
    $opts = $select->getIterator();
    $this->assertSame($select, $select->prepend($prepended = new Option('a', 'select a')));

    $this->assertSame($prepended . $opts, (string) $select->contentToString());
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
 
  public function arrayData(): iterable {
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
    $select->appendOptions($opts);
    $expected = new Select('foo');
    foreach ($opts as $index => $option) {
      if (is_array($option)) {
        $optGroup = new Optgroup((string) $index);
        $optGroup->appendOptions($option);
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
