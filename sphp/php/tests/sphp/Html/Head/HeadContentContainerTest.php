<?php

namespace Sphp\Html\Head;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\UnderflowException;

class HeadContentContainerTest extends TestCase {

  /**
   * @var HeadContentContainer
   */
  protected $container;

  /**
   * @return Head
   */
  public function createContainer(): Head {
    return new Head();
  }

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->container = new HeadContentContainer();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->container);
  }

  public function testConstructor() {
    $c = new HeadContentContainer();
    $this->assertCount(0, $c);
  }

  public function testTitle() {
    $title = new Title('title');
    $title1 = new Title('title 1');
    $this->container->setDocumentTitle($title);
    $this->assertSame($title, $this->container->getTitle());
    $this->container->setDocumentTitle($title1);
    $this->assertSame($title1, $this->container->getTitle());
    $this->assertCount(1, $this->container->getComponentsByObjectType(Title::class));
    $this->container->setDocumentTitle(null);
    $this->assertCount(0, $this->container->getComponentsByObjectType(Title::class));
    $this->expectException(UnderflowException::class);
    $this->container->getTitle();
  }

  public function testBaseAddress() {
    $base = new Base('http://foo.bar', '_blank');
    $this->container->setBaseAddress($base);
    $this->assertSame($base, $this->container->getBase());
    $base1 = new Base('http://foo.bar1', '_blank');
    $this->container->setBaseAddress($base1);
    $this->assertSame($base1, $this->container->getBase());
    $this->assertCount(1, $this->container->getComponentsByObjectType(Base::class));
    $this->container->setBaseAddress(null);
    $this->assertCount(0, $this->container->getComponentsByObjectType(Base::class));
    $this->expectException(UnderflowException::class);
    $this->container->getBase();
  }

  public function testMetaData() {
    $this->container->setMeta(Meta::applicationName('foo'));
    $this->container->setMeta(Meta::applicationName('foobar'));
    $this->assertCount(1, $this->container->getMeta());
    $this->assertCount(1, $this->container);
    $this->container->setMeta(Meta::description('foobar is foo in bar'));
    $this->assertCount(2, $this->container->getMeta());
    $this->assertCount(2, $this->container);
  }

  public function testLinks() {
    $this->container->setLink(Link::stylesheet('foo.css'));
    $this->container->setLink(Link::stylesheet('foo1.css'));
    $this->assertCount(2, $this->container->getLinks());
    $this->container->setLink(Link::stylesheet('foo1.css'));
    $this->assertCount(2, $this->container->getLinks());
    $this->container->setLink(Link::icon('foo1.css'));
    $this->assertCount(3, $this->container->getLinks());
  }

  public function testScripts() {
    $this->container->setScript(new \Sphp\Html\Scripts\ScriptCode('var $a = 0;'));
    $this->container->setScript(new \Sphp\Html\Scripts\ScriptCode('var $a = 0;'));
    $this->assertCount(2, $this->container->getScripts());
    $this->container->setScript(new \Sphp\Html\Scripts\ScriptSrc('foo.js'));
    $this->assertCount(3, $this->container->getScripts());
  }

  public function testClone() {
    $base = new Base('http://foo.bar', '_blank');
    $this->container->set($base);
    $this->container->set(new Title('Foobar'));
    $this->container->set(Meta::httpEquiv('foobar', 'bar'));
    $this->container->set(Meta::applicationName('foobar'));
    $this->container->set(Link::stylesheet('foo1.css'));
    $this->container->set(new \Sphp\Html\Scripts\ScriptCode('var $a = 0;'));
    $this->container->set(new \Sphp\Html\Scripts\ScriptSrc('foo.js'));
    $cloned = clone $this->container;
    $this->assertFalse($this->container === $cloned);
    $this->assertTrue($this->container->count() === $cloned->count());
  }

}
