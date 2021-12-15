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
use Sphp\Reflection\Utils\PHPWord;
use Sphp\Stdlib\BitMask;

/**
 * The PHPWordTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PHPWordTest extends TestCase {

  public function testBasics(): void {
    $name = '$_SERVER';
    $type = PHPWord::PREDEFINED_VAR;
    $word = new PHPWord($name, $type);

    //echo "\n $word => $type";
    $this->assertSame($word->getName(), $name);
    $this->assertSame("$word", $name);
    $this->assertEquals($word->getBitMask(), new BitMask($word->getType()));
    $this->assertSame($word->is(PHPWord::PREDEFINED_VAR), $word->isVariable());
    $this->assertSame($word->is(PHPWord::MAGIC_CONST), $word->isMagicConstantName());
    $this->assertSame($word->is(PHPWord::MAGIC_METHOD), $word->isMagicMethodName());
    $this->assertSame($word->is(PHPWord::OOP), $word->isOop());
    $this->assertSame($word->is(PHPWord::OOP | PHPWord::KEYWORD), $word->isOopKeyword());
    $this->assertSame($word->is(PHPWord::PRIMITIVE_TYPE), $word->isPrimitiveTypeName());
    $this->assertSame($word->is(PHPWord::PSEUDO_TYPE), $word->isPseudoTypeName());

    $this->assertSame($word->is(PHPWord::PSEUDO_TYPE), $word->isTypeName());
    $this->assertSame($word->is(PHPWord::KEYWORD), $word->isKeyword());
    $this->assertSame($word->is(PHPWord::CONTROL_STRUCTURE), $word->isControlStructure());
    $this->assertSame($word->is(PHPWord::LOGIGAL_OPERATOR), $word->isLogicalOperator());
  }

  public function testPrimitiveTypeWords(): void {
    $name = 'int';
    $type = PHPWord::PRIMITIVE_TYPE;
    $word = new PHPWord($name, $type);

    //echo "\n $word => $type";
    $this->assertSame($word->getName(), $name);
    $this->assertEquals($word->getBitMask(), new BitMask($word->getType()));
    $this->assertSame($word->is(PHPWord::PREDEFINED_VAR), $word->isVariable());
    $this->assertTrue($word->is(PHPWord::TYPE));
    $this->assertTrue($word->is(PHPWord::PRIMITIVE_TYPE));
    $this->assertTrue($word->isPrimitiveTypeName());
    $this->assertTrue($word->isTypeName());
    $this->assertFalse($word->isPseudoTypeName());
  }

  public function testPseudoTypeWords(): void {
    $name = 'scalar';
    $type = PHPWord::PSEUDO_TYPE;
    $word = new PHPWord($name, $type);
    $this->assertSame($word->getName(), $name);
    $this->assertEquals($word->getBitMask(), new BitMask($word->getType()));
    $this->assertSame($word->is(PHPWord::PREDEFINED_VAR), $word->isVariable());
    $this->assertFalse($word->is(PHPWord::PRIMITIVE_TYPE));
    $this->assertTrue($word->is(PHPWord::TYPE));
    $this->assertTrue($word->is(PHPWord::PSEUDO_TYPE));
    $this->assertTrue($word->isPseudoTypeName());
    $this->assertFalse($word->isPrimitiveTypeName());
    $this->assertTrue($word->isTypeName());
  }

  public function globalVariables(): iterable {
    yield [new PHPWord('$_GET', PHPWord::PREDEFINED_VAR), true];
    yield [new PHPWord('foo', PHPWord::OPERATOR), false];
    yield [new PHPWord('$_GET', PHPWord::PREDEFINED_VAR | PHPWord::OPERATOR), true];
    yield [new PHPWord('$_GET', PHPWord::PREDEFINED_VAR | PHPWord::RESERVED_WORD), true];
  }

  /**
   * @dataProvider globalVariables
   *  
   * @param  PHPWord $word
   * @param  bool $valid
   * @return void
   */
  public function testGlobalVariables(PHPWord $word, bool $valid): void {
    if ($valid) {
      $this->assertTrue($word->isVariable(),
              "$word should be regognized as global variable");
    } else {
      $this->assertFalse($word->isVariable(),
              "$word should nat be regognized as global variable");
    }
  }

  public function primitiveTypeTestData(): iterable {
    yield [new PHPWord('int', PHPWord::PRIMITIVE_TYPE), true];
    yield [new PHPWord('foo', PHPWord::TYPE), false];
    yield [new PHPWord('foo', PHPWord::PSEUDO_TYPE | PHPWord::OPERATOR), false];
    yield [new PHPWord('int', PHPWord::PRIMITIVE_TYPE | PHPWord::PSEUDO_TYPE), true];
  }

  /**
   * @dataProvider primitiveTypeTestData
   * 
   * @param  PHPWord $word
   * @param  bool $valid
   * @return void
   */
  public function testPrimitiveTypeNames(PHPWord $word, bool $valid): void {
    if ($valid) {
      $this->assertTrue($word->isPrimitiveTypeName(),
              "$word should be regognized as a primitive type name");
    } else {
      $this->assertFalse($word->isPrimitiveTypeName(),
              "$word should not be regognized as a primitive type name");
    }
  }

  public function pseudoTypeWordData(): iterable {
    yield [new PHPWord('$_GET', PHPWord::PSEUDO_TYPE), true];
    yield [new PHPWord('foo', PHPWord::TYPE), false];
    yield [new PHPWord('$_GET', PHPWord::PRIMITIVE_TYPE | PHPWord::OPERATOR), false];
    yield [new PHPWord('$_GET', PHPWord::PRIMITIVE_TYPE | PHPWord::PSEUDO_TYPE), true];
  }

  /**
   * @dataProvider pseudoTypeWordData
   * @testdox pseudo types belong to the typename group
   * 
   * @param  PHPWord $word
   * @param  bool $valid
   * @return void
   */
  public function testPseudoTypeNames(PHPWord $word, bool $valid): void {
    if ($valid) {
      $this->assertTrue($word->isPseudoTypeName(),
              "$word should be regognized as a pseudo type name");
      $this->assertTrue($word->isTypeName(),
              "pseudo type $word should be regognized as a type name");
    } else {
      $this->assertFalse($word->isPseudoTypeName(),
              "$word should not be regognized as a pseudo type name");
    }
  }

}
