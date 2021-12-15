<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\PHP\PropertytLinker;
use Sphp\Documentation\Linkers\PHP\URLGenerators\PhpDocUrls;
use Sphp\Documentation\Linkers\HyperlinkFactory;
use Sphp\Documentation\Linkers\PHP\PHPApiUrlGeneratorCollection;
use Sphp\Stdlib\Strings;
use Sphp\Reflection\PropertyReflector;

/**
 * The PropertytLinkerTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PropertytLinkerTest extends TestCase {

  protected PHPApiUrlGeneratorCollection $urlGen;

  protected function setUp(): void {
    $this->urlGen = new PHPApiUrlGeneratorCollection();
    $this->urlGen->mapNamespace('Sphp', new PhpDocUrls('/API/phpdoc/'));
  }

  public function propertyData(): iterable {
    yield [\ReflectionClass::class, 'name'];
    yield [\ReflectionClassConstant::class, 'class'];
    yield [\Sphp\Tests\Foo\Instantiable::class, 'staticProperty'];
  }

  /**
   * @dataProvider propertyData
   * 
   * @param  string $class
   * @param  string $prop
   * @return void
   */
  public function testConstructor(string $class, string $prop): void {
    $hlf = new HyperlinkFactory;
    $ref = new PropertyReflector($class, $prop);
    $linker = new PropertytLinker($ref, $this->urlGen, $hlf);
    $linker2 = PropertytLinker::create($class, "$$prop", $this->urlGen, $hlf);
    $this->assertEquals($linker, $linker2);
    $link = $linker->toHyperlink();
    $shortLink = $linker->toShortlink();
    $this->assertSame($this->urlGen->getClassPropertyUrl($class, $prop), $link->getHref());
    $defaultLinkText = "{$linker->getShortClassName()}::$$prop";
    $this->assertSame($defaultLinkText, $linker->getDefaultContent());
    $this->assertSame($defaultLinkText, $link->contentToString());
    $this->assertSame("$$prop", $shortLink->contentToString());
    $this->assertSame($this->urlGen->getClassPropertyUrl($class, $prop), $shortLink->getHref());
  }

  /**
   * @dataProvider propertyData
   * 
   * @param  string $class
   * @param  string $prop
   * @return void
   */
  public function testNavBarTirle(string $class, string $prop): void {
    $hlf = new HyperlinkFactory;
    $ref = new PropertyReflector($class, $prop);
    $linker = new PropertytLinker($ref, $this->urlGen, $hlf);
    $expected = Strings::convertCase($ref->getModifierNames(), MB_CASE_TITLE);
    $expected = "$expected Property";
    $this->assertEquals($expected, $linker->getNavBarTitle());
  }

  public function invalidPropertyData(): iterable {
    yield [\ReflectionClass::class, 'FOO'];
    yield ['bar', 'foo'];
  }

  /**
   * @dataProvider invalidPropertyData
   * 
   * @param  string $class
   * @param  string $property
   * @return void
   */
  public function testStaticCreateFailures(string $class, string $property): void {
    $hlf = new HyperlinkFactory;
    $this->expectException(\Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException::class);
    PropertytLinker::create($class, $property, $this->urlGen, $hlf);
  }

}
