<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\PHP\ClassLinker;
use Sphp\Reflection\Utils\NamespaceUtils;
use Sphp\Documentation\Linkers\PHP\URLGenerators\PhpDocUrls;
use Sphp\Documentation\Linkers\HyperlinkFactory;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;

/**
 * Description of AbstractClassLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ClassLinkerTest extends TestCase {

  protected PhpDocUrls $urlgen;

  protected function setUp(): void {
    $this->urlgen = new PhpDocUrls('/');
  }

  /**
   * 
   * @param  string $className
   * @return ClassLinker
   */
  public function createLinker(string $className = ClassLinker::class): ClassLinker {
    $linker = ClassLinker::create($className, new PhpDocUrls('/'));
    return $linker;
  }

  public function testConstructor() {
    $class = \DateTime::class;
    $linker = $this->createLinker($class);
    $classLink = $linker->toHyperlink();
    //$this->assertSame((string) $classLink, (string) $linker);
    $this->assertSame($this->urlgen->getClassUrl($class), $classLink->getHref());
    $this->assertSame($class, $classLink->contentToString());
  }

  /**
   * @return void
   */
  public function testInvoke(): void {
    $linker = ClassLinker::create(\ReflectionClass::class, new PhpDocUrls('/'));
    $this->assertEquals($linker('IS_IMPLICIT_ABSTRACT'), $linker->constantLink('IS_IMPLICIT_ABSTRACT'));
    $this->assertEquals($linker('getName'), $linker->methodLink('getName'));
    $this->assertEquals($linker('getName()'), $linker->methodLink('getName'));
    $this->assertEquals($linker('getName'), $linker->methodLink('getName()'));
    $this->assertEquals($linker('$name'), $linker->propertyLink('name'));
    $this->assertEquals($linker('name'), $linker->propertyLink('name'));
  }

  public function invalidMembers(): iterable {
    yield [\Sphp\Tests\Foo\Instantiable::class, 'x', 'constructor'];
    yield [\Sphp\Tests\Foo\Instantiable::class, '$x', 'destructor'];
    yield [\Sphp\Tests\Foo\Instantiable::class, 'X', 'instance-method'];
    yield [\Sphp\Tests\Foo\Instantiable::class, 'x()', 'instance-method'];
  }

  /**
   * @dataProvider invalidMembers
   * 
   * @param  string $class
   * @param  string $member
   * @return void
   */
  public function testInvalidInvoke(string $class, string $member) {
    $linker = ClassLinker::create($class, new PhpDocUrls('/'));
    $this->expectException(NonDocumentedFeatureException::class);
    $linker($member);
  }

  public function testClone() {
    $urls = new PhpDocUrls('/');
    $hlf = new HyperlinkFactory;
    $linker = ClassLinker::create(__CLASS__, $urls, $hlf);
    $clone = clone $linker;
    $this->assertEquals($clone, $linker);
    $this->assertNotSame($clone, $linker);
    $this->assertNotSame($hlf, $clone->getHyperlinkFactory());
  }

  public function classTypes(): array {
    $attrs = [];
    $attrs[] = [\Sphp\Html\ContentParserTrait::class, 'trait'];
    $attrs[] = [\Sphp\Html\Media\ImageMap\AbstractArea::class, 'abstract-class'];
    $attrs[] = [\Sphp\Html\Html::class, 'class'];
    $attrs[] = [\Sphp\Documentation\Linkers\DocumentationLinker::class, 'interface'];
    return $attrs;
  }

  /**
   * @dataProvider classTypes
   * 
   * @param string $class
   * @param string $type
   */
  public function testClassLink(string $class, string $type) {
    $linker = $this->createLinker($class);
    $classLink = $linker->toHyperlink();
    //$this->assertTrue($classLink->attributeExists('title'));
    $this->assertSame($this->urlgen->getClassUrl($class), $classLink->getHref(), "$class-API-link does not have '$type' as a CSS-class");
    // echo "\n{$classLink->getAttribute('class')}\n";
    //$this->assertTrue($classLink->hasCssClass($type), "$class-API-link does not have '$type' as a CSS-class");
  }

  public function methods(): array {
    $attrs = [];
    $attrs[] = [\Sphp\Tests\Foo\Instantiable::class, '__construct', 'constructor'];
    $attrs[] = [\Sphp\Tests\Foo\Instantiable::class, '__destruct', 'destructor'];
    $attrs[] = [\Sphp\Tests\Foo\Instantiable::class, '__clone', 'instance-method'];
    return $attrs;
  }

  /**
   * @dataProvider methods
   * @param string $methodName
   * @param string $type
   */
  public function testClassMethodLink(string $class, string $methodName, string $type) {
    $linker = $this->createLinker($class);
    $link = $linker->methodLink($methodName);
    $this->assertEquals($link, $linker($methodName));
    // $this->assertEquals($link, $linker->$methodName);
    $this->assertSame($this->urlgen->getClassMethodUrl($class, $methodName), $link->toHyperLink()->getHref());
    $this->assertSame($this->urlgen->getClassMethodUrl($class, $methodName), $link->getUrl());
    //$this->assertTrue($link->toHyperLink()->attributeExists('title'));
    $this->assertEquals($link->getDefaultContent(), $link->toHyperLink()->contentToString());
  }

  public function testInvalidMethodLink() {
    $linker = $this->createLinker(\stdClass::class);
    $this->expectException(NonDocumentedFeatureException::class);
    $linker->methodLink('foo');
  }

  public function constants(): array {
    $attrs = [];
    $attrs[] = [\DateTime::class, 'ATOM', 'constant'];
    $attrs[] = [\Sphp\Validators\NotEmpty::class, 'ANY_TYPE', 'constant'];
    return $attrs;
  }

  /**
   * @dataProvider constants
   * @param string $constantName
   * @param string $type
   */
  public function tsestClassConstantLink(string $class, string $constantName, string $type) {
    $linker = $this->createLinker($class);
    $link = $linker->constantLink($constantName);
    $this->assertSame($this->urlgen->getClassConstantUrl($class, $constantName), $link->getHref());
    $this->assertContains($linker->getHyperlinkFactory()->getAttributes(), $link->attributes()->reflectionClassToArray());
    $this->assertRegExp("/::$constantName$/", $link->contentToString());
  }

  /**
   * @dataProvider classTypes
   * @param string $constantName
   * @param string $type
   */
  public function tsestClassNamespaceLink(string $class) {
    $linker = $this->createLinker($class);
    $classRef = new \ReflectionClass($class);
    $namespaceName = $classRef->getNamespaceName();
    $link = $linker->namespaceLink();
    $namedLink = $linker->namespaceLink('foo');
    $shortLink = $linker->namespaceLink()->toShortHyperlink();
    $this->assertSame($this->urlgen->getNamespaceUrl($namespaceName), $link->getHref());
    $this->assertSame($this->urlgen->getNamespaceUrl($namespaceName), $shortLink->getHref());
    $this->assertTrue($link->attributeExists('title'));
    $this->assertTrue($shortLink->attributeExists('title'));
    $this->assertSame("$namespaceName namespace", $link->getAttribute('title'));
    $this->assertSame("$namespaceName namespace", $shortLink->getAttribute('title'));
    $this->assertSame('foo', $namedLink->contentToString());
    $this->assertTrue($link->hasCssClass('namespace'));
    $this->assertTrue($shortLink->hasCssClass('namespace'));
  }

  public function testClassBreadcrumbs() {
    $class = ClassLinker::class;
    $ref = new \ReflectionClass($class);
    $linker = $this->createLinker($class);
    $ns = $ref->getNamespaceName();
    //$trail = $linker->toTrail();
    $trail = $linker->toArray();
    $count = count($trail);
    $parts = NamespaceUtils::explodeNamespaceArray($ns);
    foreach ($trail as $no => $link) {
      if ($no < $count - 1) {
        $url = $this->urlgen->getNamespaceUrl($parts[$no]);
        $this->assertEquals($url, $link->getUrl());
        $this->assertEquals($url, $link->toHyperlink()->getHref());
      } else {
        $url = $this->urlgen->getClassUrl(ClassLinker::class);
        $this->assertEquals($url, $link->getUrl());
        $this->assertEquals($url, $link->toHyperlink()->getHref());
      }
    }
  }

}
