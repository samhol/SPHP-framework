<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Reflection\Utils;

use PHPUnit\Framework\TestCase;
use Sphp\Reflection\Utils\PHPWords;
use Sphp\Reflection\Utils\PHPWord;
use Sphp\Stdlib\BitMask;
use ReflectionClass;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Class PHPLanguageWordsTers
 *
 * @testdox PHPWords collection tests
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PHPWordsTest extends TestCase {

  /**
   * @return void
   */
  public function testFullCollectionIsSingelton(): void {
    $this->assertSame(PHPWords::fullCollection(), PHPWords::fullCollection());
  }

  public function fullCollectionData(): iterable {
    $words = new PHPWords();
    foreach ($words as $wordName => $word) {
      yield [$wordName, $word];
    }
  }

  /**
   * @dataProvider fullCollectionData
   * 
   * @param  string $wordName
   * @param  PHPWord $word
   * @return void
   */
  public function testCorrectMagicTypeCheckerCalls(string $wordName, PHPWord $word): void {
    $words = PHPWords::fullCollection();
    $this->assertEquals($word, $words->getWord($wordName));
    $this->assertSame($word->isVariable(), $words->isVariable($wordName));
    $this->assertSame($word->isMagicConstantName(), $words->isMagicConstantName($wordName));
    $this->assertSame($word->isMagicMethodName(), $words->isMagicMethodName($wordName));
    $this->assertSame($word->isPrimitiveTypeName(), $words->isPrimitiveTypeName($wordName));
    $this->assertSame($word->isKeyword(), $words->isKeyword($wordName));
    $this->assertSame($word->isTypeName(), $words->isTypeName($wordName));
    $this->assertSame($word->isOop(), $words->isOop($wordName));
  }

  public function testNonExistentWords() {
    $nonWord = 'foo';
    $words = PHPWords::fullCollection();
    $this->assertNull($words->getWord($nonWord));
    $this->assertFalse($words->containsWord($nonWord));
    $this->assertFalse($words->isVariable($nonWord));
    $this->assertFalse($words->isMagicConstantName($nonWord));
    $this->assertFalse($words->isMagicMethodName($nonWord));
    $this->assertFalse($words->isPrimitiveTypeName($nonWord));
    $this->assertFalse($words->isKeyword($nonWord));
    $this->assertFalse($words->isTypeName($nonWord));
    $this->assertFalse($words->isOop($nonWord));
  }

  public function incorrectCalls(): iterable {
    yield ['foo', 'if'];
    yield ['isKeyword', 'foo', 3];
    yield ['isKeyword', 3];
    yield ['isKeyword'];
  }

  /**
   * @dataProvider incorrectCalls
   * 
   * @param  string $call
   * @param  mixed ... $wordName $word
   * @return void
   */
  public function testInvalidMagicTypeCheckerCalls(string $call, ... $wordName): void {
    $words = PHPWords::fullCollection();
    $this->expectException(BadMethodCallException::class);
    $words->$call(...$wordName);
  }

  public function testIterationAndGetters(): void {
    $php = new PHPWords();

    foreach ($php as $wordName => $word) {
      //echo "\n $word => $type";
      $this->assertInstanceOf(PHPWord::class, $word);
      $this->assertTrue($php->containsWord($wordName));
      $this->assertSame($word->getName(), $wordName);
      $this->assertSame($word, $php->getWord($wordName));
      $this->assertEquals($word->getBitMask(), new BitMask($word->getType()));
      $this->assertSame($word->is(PHPWord::PREDEFINED_VAR), $word->isVariable());
      $this->assertSame($word->is(PHPWord::MAGIC_CONST), $word->isMagicConstantName());
      $this->assertSame($word->is(PHPWord::MAGIC_CONST), $php->isMagicConstantName($wordName));
      $this->assertSame($word->is(PHPWord::MAGIC_METHOD), $word->isMagicMethodName());
      $this->assertSame($word->is(PHPWord::OOP), $word->isOop());
      $this->assertSame($word->is(PHPWord::OOP | PHPWord::KEYWORD), $word->isOopKeyword());
      $this->assertSame($word->is(PHPWord::PRIMITIVE_TYPE), $word->isPrimitiveTypeName());
      if (\Sphp\Stdlib\Strings::startsWith($wordName, '$')) {
        $this->assertTrue($word->isVariable());
      }
    }
  }

  public function testConstantValuesAreUnique(): void {
    $ref = new ReflectionClass(PHPWord::class);
    $consts = $ref->getConstants();
    $this->assertSame($consts, array_unique($consts));
  }

  public function wordType(): iterable {
    $ref = new ReflectionClass(PHPWord::class);
    foreach ($ref->getConstants() as $name => $value) {
      yield [$value, $name];
    }
  }

  /**
   * @dataProvider wordType
   * 
   * @param  int $theType
   * @return void
   */
  public function testFilterByType(int $theType, string $constName): void {
    $php = new PHPWords();
    //echo "\nnumber of $constName words: " . count($php->filterByType($theType)) . "\n";
    foreach ($php->filterByType($theType) as $wordName => $word) {
      $this->assertTrue($word->is($theType));
      //echo "\n$wordName is $constName";
      $this->assertSame($word, $php->getWord($wordName));
    }
  }

}
