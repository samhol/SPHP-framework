<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use Sphp\Html\Container;
use PHPUnit\Framework\Assert;

/**
 * Class ContainerTestTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
trait ContainerTestTrait {

  abstract public function containerData(): array;

  abstract public function createEmptyContainer(): Container;

  public function testAppendPrependClearAndReset(): Container {
    $container = $this->createEmptyContainer();
    $content = $this->containerData();
    foreach ($content as $item) {
      Assert::assertFalse($container->contains($item));
      Assert::assertSame($container, $container->append($item));
      Assert::assertTrue($container->contains($item));
    }
    Assert::assertCount(count($content), $container);
    Assert::assertSame($container, $container->clear());
    return $container;
  }

  public function testEmptyContainer(): Container {
    $container = $this->createEmptyContainer();
    $content = $this->containerData();
    Assert::assertCount(0, $container);
    foreach ($content as $item) {
      Assert::assertFalse($container->contains($item));
    }
    return $container;
  }

  /**
   * @depends testEmptyContainer
   * 
   * @param  Container $container
   * @return Container
   */
  public function testAppendToContainer(Container $container): Container {
    $content = $this->containerData();
    $out = '';
    foreach ($content as $item) {
      Assert::assertSame($container, $container->append($item));
      Assert::assertTrue($container->contains($item));
      $out .= $item;
      Assert::assertStringContainsString($out, $container->getHtml());
    }
    Assert::assertCount(count($content), $container);
    return $container;
  }

  /**
   * @depends testAppendToContainer
   * 
   * @param Container $container
   * @return Container
   */
  public function testPrependToContainer(Container $container): Container {
    $content = $this->containerData();
    $out = implode('', $content);
    foreach ($content as $item) {
      $out = $item . $out;
      $this->assertSame($container, $container->prepend($item));
    }
    $this->assertCount(2 * count($content), $container);
    $this->assertSame($container, $container->clear());
    return $container;
  }

  /**
   * @depends testPrependToContainer
   * 
   * @param Container $container
   * @return Container
   */
  public function testResetContent(Container $container): Container {
    $content = $this->containerData();
    foreach ($content as $item) {
      Assert::assertSame($container, $container->resetContent($item));
      Assert::assertTrue($container->contains($item));
      Assert::assertCount(1, $container);
    }
    return $container;
  }

  /**
   * @return void
   */
  public function testContainerToArray(): void {
    $container = $this->createEmptyContainer();
    $content = $this->containerData();
    foreach ($content as $item) {
      $container->append($item);
    }
    $containerArray = $container->toArray();
    foreach ($content as $item) {
      Assert::assertContains($item, $containerArray);
    }
    Assert::assertSame(iterator_to_array($container), $container->toArray());
  }

}
