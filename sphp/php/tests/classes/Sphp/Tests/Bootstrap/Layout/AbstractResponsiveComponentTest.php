<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Bootstrap\Layout;

use PHPUnit\Framework\TestCase;
use Sphp\Bootstrap\Exceptions\BootstrapException;
use Sphp\Bootstrap\Exceptions\BadMethodCallException;
use Sphp\Bootstrap\Layout\AbstractResponsiveComponent;

/**
 * The AbstractResponsiveComponent tessting class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractResponsiveComponentTest extends TestCase {

  protected AbstractResponsiveComponent $manager;

  protected function setUp(): void {
    $this->manager = $this->buildManager();
  }

  public function buildManager(array $params = ['prefix' => 'col']): AbstractResponsiveComponent {
    $stub = $this->getMockForAbstractClass(AbstractResponsiveComponent::class, ['div', $params]);
    return $stub;
  }

  public function testNullPrefix() {
    $manager = $this->buildManager(['prefix' => null]);
    $manager->setLayout('xxl', 'auto');
    $this->assertTrue($manager->hasCssClass('xxl-auto'));
    $this->manager->setLayout(null, 'auto');
    $this->assertTrue($manager->hasCssClass('xxl-auto'));
  }

  /**
   * @return array 
   */
  public function breakpointData(): array {
    $data = [];
    $data[] = [['sm', 'lg', 'lg', 'md', 'xl', 'xxl']];
    $data[] = [range('a', 'f')];
    return $data;
  }

  /**
   * @dataProvider breakpointData
   * 
   * @param  string[] $breakpoints
   * @return void
   */
  public function testBreakpointGetter(array $breakpoints): void {
    $mngr = $this->buildManager(['breakpoints' => $breakpoints]);
    $this->assertSame($breakpoints, $mngr->getBreakpoints());
    foreach ($breakpoints as $breakpoint) {
      $this->assertSame($mngr, $mngr->$breakpoint(1));
    }
  }

  /**
   * @return array 
   */
  public function sizeData(): array {
    $data = [];
    $data[] = [['sm', 'lg', 'lg', 'md', 'xl', 'xxl']];
    $val2 = range(1, 6);
    $val2[] = 'foo';
    $data[] = [$val2];
    return $data;
  }

  /**
   * @dataProvider sizeData
   * 
   * @param  string[] $sizes
   * @return void
   */
  public function testSizeGetter(array $sizes): void {
    $mngr = $this->buildManager(['sizes' => $sizes]);
    $this->assertSame($sizes, $mngr->getSizes());
  }

  /**
   * @return void
   */
  public function testConstructorWithParams(): void {
    $settings['prefix'] = 'foo';
    $settings['breakpoints'] = ['sm', 'lg', 'lg', 'md', 'xl', 'xxl'];
    $sizes = range(1, 12);
    $sizes[] = 'auto';
    $settings['sizes'] = $sizes;
    $mngr = $this->buildManager($settings);
    $this->assertCount(0, $mngr->cssClasses());
    $this->assertSame($settings['breakpoints'], $mngr->getBreakpoints());
    $this->assertSame($settings['sizes'], $mngr->getSizes());
    $this->assertSame($settings['prefix'], $mngr->getPrefix());
  }

  /**
   * @return void
   */
  public function testSetLayout(): void {
    $prefix = $this->manager->getPrefix();
    foreach ($this->manager->getBreakpoints() as $breakpoint) {
      foreach ($this->manager->getSizes() as $size) {
        $this->assertFalse($this->manager->hasCssClass($prefix . "-$breakpoint-$size"));
        $this->assertSame($this->manager, $this->manager->setLayout($breakpoint, $size));
        $this->assertTrue($this->manager->hasCssClass($prefix . "-$breakpoint-$size"));
      }
    }
    $this->assertSame($this->manager, $this->manager->setLayout(null, $size));
    $this->assertTrue($this->manager->hasCssClass($prefix . "-$size"));
    $this->assertSame($this->manager, $this->manager->setLayout(null, null));
    $this->assertFalse($this->manager->hasCssClass($prefix . "-$size"));
  }

  /**
   * @return array 
   */
  public function invalidSizeParameters(): array {
    $params = [];
    $params[] = ['sm', 13];
    $params[] = ['', 1];
    $params[] = [null, 'foo'];
    return $params;
  }

  /**
   * @dataProvider invalidSizeParameters
   * 
   * @param string|null $breakpoint
   * @param type $size
   * @return void
   */
  public function testSetSizeFailure(?string $breakpoint, $size): void {
    $this->expectException(BootstrapException::class);
    $this->manager->setLayout($breakpoint, $size);
  }

  /**
   * @return array 
   */
  public function validLayoutParameters(): array {
    $params = [];
    $params[] = [['sm-auto', 'xxl-12'], ['col-sm-auto', 'col-xxl-12']];

    return $params;
  }

  /**
   * @dataProvider validLayoutParameters
   * 
   * @param array $layouts
   * @return void
   */
  public function testSetLayouts(array $layouts, array $classes): void {
    $this->assertSame($this->manager, $this->manager->setLayouts(...$layouts));
    $this->assertTrue($this->manager->hasCssClass(...$classes));
    $this->assertCount(count($classes), $this->manager->cssClasses());
    $this->expectException(BootstrapException::class);
    $this->manager->setLayout('col', 'col-1', 'col-13');
  }

  /**
   * @return void
   */
  public function testMagic(): void {
    foreach ($this->manager->getBreakpoints() as $breakpoint) {
      $this->assertSame($this->manager, $this->manager->$breakpoint(1));
      $this->assertTrue($this->manager->hasCssClass("col-$breakpoint-1"));
      $this->assertSame($this->manager, $this->manager->$breakpoint(null));
      $this->assertFalse($this->manager->hasCssClass("col-$breakpoint-1"));
      $this->assertSame($this->manager, $this->manager->$breakpoint(2));
      $this->assertTrue($this->manager->hasCssClass("col-$breakpoint-2"));
      $this->assertFalse($this->manager->hasCssClass("col-$breakpoint-1"));
      $this->assertSame($this->manager, $this->manager->unsetBreakpoint($breakpoint));
      $this->assertFalse($this->manager->cssClasses()->contaisPattern("/^(col-$breakpoint(-([1-9]|(1[0-2])|auto))?)$/"));
    }
    $this->expectException(BadMethodCallException::class);
    $this->manager->foo('auto');
  }

  /**
   * @return array<string, array, string>
   */
  public function invalidMagicData(): array {
    $data = [];
    $data[] = ['sm', [], BadMethodCallException::class];
    $data[] = ['sm', ['foo']];
    $data[] = ['lg', [1, 2, 3], BadMethodCallException::class];
    $data[] = ['foo', [1], BadMethodCallException::class];
    return $data;
  }

  /**
   * @dataProvider invalidMagicData
   * 
   * @param  string $name
   * @param  array $params
   * @param  string $exceptionType
   * @return void
   */
  public function testFailedMagicMethods(string $name, array $params, string $exceptionType = BootstrapException::class): void {
    $this->expectException($exceptionType);
    $this->manager->$name(...$params);
  }

  /**
   * @return array<int, string>
   */
  public function unsetBreakpoints(): array {
    $ints[] = ['sm'];
    $ints[] = ['lg'];
    $ints[] = ['md'];
    $ints[] = ['xl'];
    $ints[] = ['xxl'];
    return $ints;
  }

  public function testSetAndUnsetDefault(): void {
    $mngr1 = $this->buildManager();
    $mngr2 = $this->buildManager();
    $classCount = $mngr1->cssClasses()->count();
    $this->assertCount(0, $mngr1->cssClasses());
    $this->assertSame($mngr1, $mngr1->default(2));
    $this->assertCount($classCount + 1, $mngr1->cssClasses());
    $this->assertTrue($mngr1->hasCssClass('col-2'));
    $this->assertSame($mngr1, $mngr1->unsetDefault());
    $this->assertEquals($mngr1->cssClasses(), $mngr2->cssClasses());
  }

  public function testDefaultFailure(): void {
    $this->expectException(BootstrapException::class);
    $this->manager->default('foo');
  }

  public function testUnsetBreakpointFailure(): void {
    $this->expectException(BootstrapException::class);
    $this->manager->unsetBreakpoint('foo');
  }

  /**
   * @dataProvider unsetBreakpoints
   * 
   * @param string $breakpoint
   * @return void
   */
  public function testUnsetBreakpoint(string $breakpoint): void {
    $this->assertSame($this->manager, $this->manager->$breakpoint(2));
    $this->assertTrue($this->manager->hasCssClass("col-$breakpoint-2"));
    $this->assertSame($this->manager, $this->manager->unsetBreakpoint($breakpoint));
    $this->assertFalse($this->manager->hasCssClass("col-$breakpoint-2"));
    $this->assertFalse($this->manager->cssClasses()->contaisPattern("/^(($breakpoint)(-([1-9]|(1[0-2])|auto)))$/"));
    $this->expectException(BootstrapException::class);
    $this->manager->unsetBreakpoint('foo');
  }

  /**
   * @return array<int, string>
   */
  public function unsetWidthsData(): array {
    $ints[] = ['sm', 'col'];
    $ints[] = ['lg'];
    $ints[] = ['md'];
    $ints[] = ['xl'];
    $ints[] = ['xxl'];
    return $ints;
  }

  /**
   * @dataProvider unsetBreakpoints
   * 
   * @param string $breakpoint
   * @return void
   */
  public function testUnsetBreakpoints(string ...$breakpoint): void {
    $regex = "/^((" . implode('|', $breakpoint) . ")(-([1-9]|(1[0-2])|auto)))$/";
    $this->assertSame($this->manager, $this->manager->unsetBreakpoints(...$breakpoint));
    $this->assertFalse($this->manager->cssClasses()->contaisPattern($regex));
    $this->expectException(BootstrapException::class);
    $this->manager->unsetBreakpoints('col-lg', 'foo');
  }

}
