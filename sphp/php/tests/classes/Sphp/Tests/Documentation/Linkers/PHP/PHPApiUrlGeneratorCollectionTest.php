<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\PHP\PHPManual\PHPManualURLs;
use Sphp\Documentation\Linkers\PHP\PHPApiUrlGeneratorCollection;
use Sphp\Documentation\Linkers\PHP\PHPApiUrlGenerator;
use Sphp\Html\Lists\Ol;
use Sphp\Stdlib\Strings;
use Sphp\Tests\Foo\Instantiable;
use Sphp\Documentation\Linkers\PHP\URLGenerators\{
  SamiUrls,
  ApiGenUrls,
  PhpDocUrls
};

/**
 * Description of PHPApiUrlGeneratorCollectionTests
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PHPApiUrlGeneratorCollectionTest extends TestCase {

  protected PHPApiUrlGeneratorCollection $gen;

  /**
   * @var PHPApiUrlGenerator[]
   */
  protected array $linkers;

  protected function setUp(): void {
    $this->gen = new PHPApiUrlGeneratorCollection();
    $this->gen->mapNamespace('Sphp', $this->linkers['Sphp'] = new SamiUrls('Sphp/', 'SPHPPlayground Manual'));
    $this->gen->mapNamespace('Sphp\Html', $this->linkers['Sphp\Html'] = new PhpDocUrls('Html/'));
    $this->gen->mapNamespace('Sphp\Stdlib', $this->linkers['Sphp\Stdlib'] = new PhpDocUrls('Stdlib/'));
  }

  public function testConstructor(): void {
    $phpManual = new PHPManualURLs();
    $gen = new PHPApiUrlGeneratorCollection($phpManual);
    $this->assertSame($phpManual, $gen->getPHPManual());
  }

  public function testIteratingAndCounting(): void {
    $it1 = $this->gen->getIterator();
    $it2 = $this->gen->getIterator();
    $this->assertNotSame($it1, $it2);
    $this->assertEquals($it1, $it2);
    foreach ($this->gen as $ns => $nsGen) {
      $this->assertSame($nsGen, $this->gen->getLinkerFor($ns));
    }
    $this->assertCount(count($this->linkers), $this->gen);
  }

  /**
   * @depends testIteratingAndCounting
   * 
   * @return void
   */
  public function testClone(): void {
    $clone = clone $this->gen;
    foreach ($this->gen as $ns => $nsGen) {
      $this->assertNotSame($nsGen, $clone->getLinkerFor($ns));
      $this->assertEquals($nsGen, $clone->getLinkerFor($ns));
    }
    $this->assertNotSame($this->gen->getPHPManual(), $clone->getPHPManual());
    $this->assertEquals($this->gen->getPHPManual(), $clone->getPHPManual());
  }

  /**
   * @depends testIteratingAndCounting
   * 
   * @return void
   */
  public function testGetRootAndApiName(): void {
    $this->assertEquals($this->gen->getPHPManual()->getRootUrl(), $this->gen->getRootUrl());
    $this->assertEquals($this->gen->getPHPManual()->getApiname(), $this->gen->getApiname());
    foreach ($this->gen as $ns => $nsGen) {
      $this->assertEquals($nsGen->getRootUrl(), $this->gen->getRootUrl($ns));
      $this->assertEquals($nsGen->getApiname(), $this->gen->getApiname($ns));
    }
  }

  public function testMapping(): void {
    $gen = new PHPApiUrlGeneratorCollection();
    $this->assertSame($gen, $gen->mapNamespace('\Sami', $sami = new SamiUrls('sami/', 'Sami Docs')));
    $this->assertSame($gen, $gen->mapNamespace('ns\PhpDoc', $phpdoc = new PhpDocUrls('phpdoc/', 'phpdoc Docs')));
    $this->assertSame($gen, $gen->mapNamespace('ns\ApiGen', $apigen = new ApiGenUrls('apigen/', 'apigen Docs')));
    $this->assertInstanceOf(PHPManualURLs::class, $gen->getLinkerFor('ns'));
    $this->assertSame($sami, $gen->getLinkerFor('\Sami'));
    $this->assertSame($phpdoc, $gen->getLinkerFor('ns\PhpDoc'));
    $this->assertSame($apigen, $gen->getLinkerFor('ns\ApiGen'));
    $this->assertSame($apigen->getApiname(), $gen->getApiname('ns\ApiGen'));
  }

  public function testSubNamespaces(): PHPApiUrlGeneratorCollection {
    $gen = new PHPApiUrlGeneratorCollection();
    $gen->mapNamespace('\Sami', $sami = new SamiUrls('sami/', 'Sami Docs'));
    $this->assertSame($gen, $gen->mapNamespace('Sami\Html', $phpdoc = new PhpDocUrls('phpdoc/')));
    $this->assertSame($phpdoc, $gen->getLinkerFor('Sami\Html\Forms'), 'Sami\Html\Forms');
    $this->assertSame($sami, $gen->getLinkerFor('Sami\Apps'));
    return $gen;
  }

  public function testNamespaceUrls(): void {
    $this->assertEquals($this->linkers['Sphp']->getNamespaceUrl('Sphp\Bar'), $this->gen->getNamespaceUrl('Sphp\Bar'));
    $this->assertEquals($this->linkers['Sphp\Html']->getNamespaceUrl('Sphp\Html\Foo'), $this->gen->getNamespaceUrl('Sphp\Html\Foo'));
    $this->assertEquals($this->linkers['Sphp\Stdlib']->getNamespaceUrl('Sphp\Stdlib\Bar'), $this->gen->getNamespaceUrl('Sphp\Stdlib\Bar'));
    $this->assertEquals($this->gen->getPHPManual()->getNamespaceUrl('UI'), $this->gen->getNamespaceUrl('UI'));
  }

  public function testConstantUrls(): void {
    $this->assertEquals($this->linkers['Sphp']->getConstantUrl('Sphp\Tests\Foo\FOO_CONST'), $this->gen->getConstantUrl('\Sphp\Tests\Foo\FOO_CONST'));
    $this->assertEquals($this->gen->getPHPManual()->getConstantUrl('E_ALL'), $this->gen->getConstantUrl('E_ALL'));
  }

  public function testInvalidConstantUrls(): void {
    $this->expectException(\Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException::class);
    $this->gen->getConstantUrl('Sphp\FOc d');
  }

  public function testClassUrls(): void {
    $this->assertEquals($this->linkers['Sphp\Html']->getClassUrl(Ol::class), $this->gen->getClassUrl(Ol::class));
    $this->assertEquals($this->linkers['Sphp\Stdlib']->getClassUrl(Strings::class), $this->gen->getClassUrl(Strings::class));
    $this->assertEquals($this->gen->getPHPManual()->getClassUrl(\ArrayObject::class), $this->gen->getClassUrl(\ArrayObject::class));
  }

  public function testMethodUrls(): void {
    $this->assertEquals($this->linkers['Sphp\Html']->getClassMethodUrl(Ol::class, '__toString'), $this->gen->getClassMethodUrl(Ol::class, '__toString'));
    $this->assertEquals($this->linkers['Sphp\Stdlib']->getClassMethodUrl(Strings::class, 'match'), $this->gen->getClassMethodUrl(Strings::class, 'match'));
    $this->assertEquals($this->gen->getPHPManual()->getClassMethodUrl(\ArrayObject::class, 'count'), $this->gen->getClassMethodUrl(\ArrayObject::class, 'count'));
  }

  public function testClassConstantUrls(): void {
    $this->assertEquals($this->linkers['Sphp\Html']->getClassConstantUrl(Ol::class, 'DECIMAL'), $this->gen->getClassConstantUrl(Ol::class, 'DECIMAL'));
    $this->assertEquals($this->linkers['Sphp\Stdlib']->getClassConstantUrl(Strings::class, 'UPPER_CASE'), $this->gen->getClassConstantUrl(Strings::class, 'UPPER_CASE'));
    $this->assertEquals($this->gen->getPHPManual()->getClassConstantUrl(\ArrayObject::class, 'ARRAY_AS_PROPS'), $this->gen->getClassConstantUrl(\ArrayObject::class, 'ARRAY_AS_PROPS'));
  }

  public function testPropertyUrls(): void {
    $this->assertEquals($this->linkers['Sphp']->getClassPropertyUrl(Instantiable::class, '$bar'), $this->gen->getClassPropertyUrl(Instantiable::class, 'bar'));
    $this->assertEquals($this->gen->getPHPManual()->getClassPropertyUrl(\ReflectionClass::class, 'name'), $this->gen->getClassPropertyUrl(\ReflectionClass::class, 'name'));
  }

  public function testFunctionUrls(): void {
    $this->assertEquals($this->linkers['Sphp']->getFunctionUrl('Sphp\Tests\Foo\foo'), $this->gen->getFunctionUrl('Sphp\Tests\Foo\foo()'));
    $this->assertEquals($this->gen->getPHPManual()->getFunctionUrl('array_key_exists'), $this->gen->getFunctionUrl('array_key_exists'));
  }

}
