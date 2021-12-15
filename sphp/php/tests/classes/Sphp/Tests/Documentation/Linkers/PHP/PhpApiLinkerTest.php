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
use Sphp\Documentation\Linkers\PHP\PHPApiUrlGeneratorCollection;
use Sphp\Documentation\Linkers\PHP\PhpApiLinker;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;

/**
 * Description of AbstractPhpApiLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PhpApiLinkerTest extends TestCase {

  protected PHPApiUrlGeneratorCollection $urlgen;
  protected PhpApiLinker $linker;

  protected function setUp(): void {
    $this->urlgen = new PHPApiUrlGeneratorCollection();
    $this->urlgen->mapPhpDoc('Sphp', 'API/PhPdoc/', 'PhpDoc');
    $this->urlgen->mapDoctum('Sphp\Html', 'API/doctum/', 'doctum Docs');
    $this->linker = new PhpApiLinker($this->urlgen);
  }

  public function testConstructor() {
    $emptyLinker = new PhpApiLinker();
    $this->assertInstanceOf(PHPApiUrlGeneratorCollection::class, $emptyLinker->urls());
    $this->assertCount(0, $emptyLinker->urls());
    $linker = new PhpApiLinker($this->urlgen);
    $this->assertSame($this->urlgen, $linker->urls());
  }

  public function functionData(): array {
    $attrs = [];
    $attrs[] = ['trim'];
    return $attrs;
  }

  public function testInvokingAndBuild(): void {
    $this->assertEquals($this->linker->constantLink('PHP_INT_MAX'), $this->linker->build('PHP_INT_MAX'));
    $this->assertEquals($this->linker->functionLink('abs()'), $this->linker->build('abs()'));
    $this->assertEquals($this->linker->functionLink('abs'), $this->linker->build('abs'));
    $this->assertEquals($this->linker->classLinker(\DateTime::class), $this->linker->build(\DateTime::class));
    $this->assertEquals($this->linker->languageReference('string'), $this->linker->build('string'));
  }

  /**
   * @dataProvider functionData
   * 
   * @param string $functionName
   */
  public function testFunctionLink(string $functionName) {
    $link = $this->linker->functionLink($functionName)->toHyperlink();
    $this->assertSame($this->linker->urls()->getFunctionUrl($functionName), $link->getHref());
  }

  /**
   * @return iterable<int, array<string>>
   */
  public function methods(): iterable {
    yield [\Sphp\Tests\Foo\Instantiable::class, '__construct', 'constructor'];
    yield [\Sphp\Tests\Foo\Instantiable::class, '__destruct', 'destructor'];
    yield[\Sphp\Tests\Foo\Instantiable::class, '__clone', 'instance-method'];
  }

  /**
   * @dataProvider methods
   * 
   * @param  string $className
   * @param  string $methodName
   * @return void
   */
  public function testMethodLinking(string $className, string $methodName): void {
    $classLinker = $this->linker->classLinker($className);
    $methodLinker = $classLinker($methodName);
    $daLinker = $this->linker;
    $this->assertEquals($methodLinker, $daLinker("$className::$methodName"));
  }

  /**
   * @return iterable<int, array<string>>
   */
  public function invalidBuildParam(): iterable {
    yield ['/'];
    yield ['*#'];
  }

  /**
   * @dataProvider invalidBuildParam
   * 
   * @param  string $invalidParam 
   * @return void
   */
  public function testInvalidBuild(string $invalidParam): void {
    $this->expectException(NonDocumentedFeatureException::class);
    $this->linker->build($invalidParam);
  }

  public function constants(): array {
    $attrs = [];
    $attrs[] = ['PHP_EOL'];
    //$attrs[] = ['\Sphp\Regex\NUMBERS_ONLY'];
    return $attrs;
  }

  /**
   * @dataProvider constants
   * @param string $constant
   */
  public function testConstantLinking(string $constant) {
    $link = $this->linker->constantLink($constant)->toHyperlink();
    $namedLink = $this->linker->constantLink($constant)->toHyperlink('foo');
    $this->assertSame($this->urlgen->getConstantUrl($constant), $link->getHref());
    $this->assertTrue($link->hasCssClass('constant'));
    $this->assertMatchesRegularExpression("/$constant/", $link->contentToString());
    $this->assertSame('foo', $namedLink->contentToString());
  }

  public function namespaceData(): array {
    $attrs = [];
    $attrs[] = [__NAMESPACE__, 'namespace'];
    return $attrs;
  }

  /**
   * @dataProvider namespaceData
   * @param string $constantName
   * @param string $type
   */
  public function testNamespaceLink(string $namespace) {
    $linker = $this->linker->namespaceLink($namespace);
    $this->assertEquals($linker, $this->linker->__invoke($namespace));
    $this->assertEquals($linker, $this->linker->build($namespace));
    $this->assertSame($this->urlgen->getNamespaceUrl($namespace), $linker->toHyperlink()->getHref());
    $this->assertSame($this->urlgen->getNamespaceUrl($namespace), $linker->toHyperlink()->getHref());
    //$this->assertTrue($link->attributeExists('title'));
    //$this->assertSame("The $namespace namespace", $link->getAttribute('title'));
    //$this->assertTrue($link->hasCssClass('namespace'));
  }

}
