<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Reflection;

use PHPUnit\Framework\TestCase;
use Sphp\Reflection\ConstantReflector;
use Sphp\Reflection\Exceptions\ReflectionException;
use Sphp\Reflection\ExtensionReflector;

/**
 * Description of ReflectionConstantTests
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ReflectionConstantTest extends TestCase {

  public function magicConstantMap(): array {
    $arr = [];
    $arr[] = ['__CLASS__'];
    $arr[] = ['__FUNCTION__'];
    $arr[] = ['__LINE__'];
    $arr[] = ['__FILE__'];
    $arr[] = ['__NAMESPACE__'];
    $arr[] = ['__DIR__'];
    $arr[] = ['__TRAIT__'];
    return $arr;
  }

  /**
   * @dataProvider magicConstantMap
   * 
   * @param  string $name
   * @return void
   */
  public function atestMagicConsstants(string $name): void {
    $ref = new ConstantReflector($name);
    $this->assertFalse($ref->isUserDefined());
    $this->assertTrue($ref->isInternal());
    $this->assertTrue($ref->isMagicConstant());
    $this->assertNull($ref->getExtensionName());
    $this->assertNull($ref->getExtension());
  }

  public function internalConstantMap(): array {
    $arr = [];
    $arr[] = ['__CLASS__', null];
    $arr[] = ['__FUNCTION__', null];
    $arr[] = ['__LINE__', null];
    $arr[] = ['__FILE__', null];
    $arr[] = ['__NAMESPACE__', null];
    $arr[] = ['__DIR__', null];
    $arr[] = ['__TRAIT__', null];
    $arr[] = ['PHP_INT_MAX', 'Core'];
    $arr[] = ['INI_USER', 'standard'];
    $arr[] = ['INPUT_GET', 'filter'];
    $arr[] = ['MB_CASE_UPPER', 'mbstring'];
    $arr[] = ['DATE_COOKIE', 'date'];
    return $arr;
  }

  /**
   * @dataProvider internalConstantMap
   * 
   * @param  string $name
   * @param  string|null $extName
   * @return void
   */
  public function testInternalConsstants(string $name, string $extName = null): void {
    $ref = new ConstantReflector($name);
    $this->assertFalse($ref->isUserDefined());
    $this->assertTrue($ref->isInternal());
    if ($extName === null) {
      $this->assertTrue($ref->isMagicConstant());
      $this->assertNull($ref->getExtensionName());
      $this->assertNull($ref->getExtension());
    } else {
      $this->assertTrue($ref->isDefined());
      $this->assertEquals($extName, $ref->getExtensionName());
      $this->assertEquals(new ExtensionReflector($extName), $ref->getExtension());
    }
  }

  /**
   * @return iterable 
   */
  public function userDefinedConstantMap(): iterable {
    yield ['\Sphp\Tests\Foo\FOO_CONST'];
    yield ['\Sphp\Tests\Foo\ANOTHER_CONST'];
  }

  /**
   * @dataProvider userDefinedConstantMap
   *
   * @param  string $name
   * @return void
   */
  public function testUserDefinedConstants(string $name): void {
    $ref = new ConstantReflector($name);
    $this->assertNull($ref->getExtensionName());
    $this->assertNull($ref->getExtension());
    $this->assertTrue($ref->isUserDefined());
    $this->assertFalse($ref->isInternal(), "User defined constant $name can not be internal");
    $this->assertFalse($ref->isMagicConstant(), "User defined constant $name can not be magic");
    if (!$ref->inNamespace()) {
      $this->assertSame('', $ref->getNamespaceName());
      $this->assertSame($name, $ref->getShortName());
    } else {
      $this->assertSame($name, $ref->getNamespaceName() . "\\" . $ref->getShortName());
    }
  }

  public function invalidNameMap(): array {
    $arr = [];
    $arr[] = ['1'];
    $arr[] = [' '];
    $arr[] = ['\\'];
    $arr[] = ['+'];
    $arr[] = ['\Sphp\Tests\Foo\1FOO'];
    return $arr;
  }

  /**
   * @dataProvider invalidNameMap
   * 
   * @param  string $name
   * @return void
   */
  public function testInvalidConstructorCall(string $name): void {
    $this->expectException(ReflectionException::class);
    new ConstantReflector($name);
  }

  public function validConstantMap(): array {
    $arr = [];
    $arr[] = ['PHP_INT_MAX'];
    $arr[] = ['IMAGETYPE_BMP'];
    $arr[] = ['CURLOPT_COOKIESESSION'];
    $arr[] = ['\Sphp\Tests\Foo\FOO_CONST'];
    return $arr;
  }

  /**
   * @dataProvider validConstantMap
   * 
   * @param  string $name
   * @return void
   */
  public function testGetValueAndToString(string $name): void {
    $ref = new ConstantReflector($name);
    if ($ref->isDefined()) {
      $this->assertSame("const {$ref->getName()}: " . $ref->getValue(), (string) $ref);
    } else {
      $this->assertNull($ref->getValue());
    }
    $this->assertSame(constant($name), $ref->getValue());
  }

  public function testRuntimeDefinedConstant() {
    $ref = new ConstantReflector('E_ALL');
    $this->assertTrue($ref->isInternal());
    define('B', 'b');
    $refA = new ConstantReflector('B');
    $this->assertTrue($refA->isDefined());
    $this->assertFalse($refA->isInternal());
    $this->assertTrue($refA->isUserDefined());
    $this->assertNull($refA->getExtensionName());
  }

}
