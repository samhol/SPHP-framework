<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Head;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Head\MetaContainer;
use Sphp\Html\Head\Base;
use Sphp\Html\Head\Title;
use Sphp\Html\Head\MetaFactory;
use Sphp\Html\Scripts\InlineScript;
use Sphp\Html\Scripts\ExternalScript;

class MetaContainerTest extends TestCase {

  public function testConstructor() {
    $metaData = new MetaContainer();
    $this->assertCount(0, $metaData);
    $this->assertEmpty($metaData);
    $this->assertEmpty($metaData->toArray());
    $this->assertSame('', $metaData->getHtml());
  }

  public function testTitle() {
    $metaData = new MetaContainer();
    $titleObj = $metaData->setTitle('title');
    $this->assertContains($titleObj, $metaData);
    $this->assertCount(1, $metaData);
    $metaData->remove($titleObj);
    $this->assertCount(0, $metaData);
  }

  public function testBaseAddress() {
    $metaData = new MetaContainer();
    $base = $metaData->setBaseAddress('http://bar', '_blank');
    $this->assertSame($base->getHtml(), $metaData->getHtml());
    $this->assertCount(1, $metaData);
    $this->assertContains($base, $metaData);
    $base1 = new Base('http://foo', '_blank');
    $metaData->insert($base1);
    $this->assertCount(1, $metaData);
    $this->assertNotContains($base, $metaData);
    $this->assertContains($base1, $metaData);
    $metaData->remove($base1);
    $this->assertCount(0, $metaData);
  }

  public function testMetaData() {
    $metaData = new MetaContainer();
    $metaData->insert(MetaFactory::build()->applicationName('foo'));
    $this->assertCount(1, $metaData);
    $metaData->insert(MetaFactory::build()->applicationName('foobar'));
    $this->assertCount(1, $metaData);
    $metaData->insert(MetaFactory::build()->description('bar'));
    $this->assertCount(2, $metaData);
  }

  public function testLinks() {
    $metaData = new MetaContainer();
    $metaData->insert(MetaFactory::build()->stylesheet('foo.css'));
    $metaData->insert(MetaFactory::build()->stylesheet('foo1.css'));
    $this->assertCount(2, $metaData);
    $metaData->insert(MetaFactory::build()->stylesheet('foo1.css'));
    $this->assertCount(2, $metaData);
    $metaData->insert(MetaFactory::build()->icon('foo1.css'));
    $this->assertCount(3, $metaData);
  }

  public function testScripts() {
    $metaData = new MetaContainer();
    $metaData->insert(new InlineScript('var $a = 0;'));
    $metaData->insert(new InlineScript('var $a = 0;'));
    $this->assertCount(2, $metaData);
    $metaData->insert(new ExternalScript('foo.js'));
    $this->assertCount(3, $metaData);
  }

  public function testClone() {
    $metaData = new MetaContainer();
    $base = new Base('http://foo.bar', '_blank');
    $metaData->insert($base);
    $metaData->insert(new Title('Foobar'));
    $metaData->insert(MetaFactory::build()->httpEquiv('foobar', 'bar'));
    $metaData->insert(MetaFactory::build()->applicationName('foobar'));
    $metaData->insert(MetaFactory::build()->stylesheet('foo1.css'));
    $metaData->insert(new InlineScript('var $a = 0;'));
    $metaData->insert(new ExternalScript('foo.js'));
    $cloned = clone $metaData;
    $this->assertFalse($metaData === $cloned);
    $this->assertTrue($metaData->count() === $cloned->count());
  }

  public function testInsertAll(): void {
    $container = new MetaContainer();
    $meta = [];
    $meta[] = new Title('Foobar');
    $meta[] = MetaFactory::build()->httpEquiv('foobar', 'bar');
    $meta[] = MetaFactory::build()->applicationName('foobar');
    $meta[] = MetaFactory::build()->stylesheet('foo1.css');
    $meta[] = new InlineScript('var $a = 0;');
    $meta[] = new ExternalScript('foo.js');
    $meta[] = new Base('http://foo', '_blank');
    $container->insertAll($meta);
    $this->assertSame(implode('', $meta), $container->getHtml());
  }

}
