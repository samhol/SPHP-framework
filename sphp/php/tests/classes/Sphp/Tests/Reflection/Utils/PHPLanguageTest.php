<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Reflection\Utils;

use PHPUnit\Framework\TestCase;
use Sphp\Reflection\Utils\PHPLanguage;

/**
 * Class PHPLanguageTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PHPLanguageTest  {

  public function controlStructurNames(): iterable {
    foreach (PHPLanguage::getControlStructures() as $name) {
      yield [$name, true];
    }
    yield ['__CLASS__', false];
  }

  /**
   * @dataProvider controlStructurNames
   * 
   * @param  string $name
   * @param  bool $valid
   * @return void
   */
  public function testControlStructures(string $name, bool $valid): void {
    if ($valid) {
      $this->assertTrue(PHPLanguage::isControlStructure($name));
      $this->assertTrue(PHPLanguage::isReservedWord($name));
    } else {
      $this->assertFalse(PHPLanguage::isControlStructure($name));
    }
  }

  public function globalVariables(): iterable {
    foreach (PHPLanguage::getGlobalVariables() as $varName) {
      yield [$varName, true];
    }
    yield ['$_FOO', false];
    yield ['__CLASS__', false];
  }

  /**
   * @dataProvider globalVariables
   *  
   * @param  string $varName
   * @param  bool $valid
   * @return void
   */
  public function testGlobalVariabless(string $varName, bool $valid): void {
    if ($valid) {
      $this->assertTrue(PHPLanguage::isGlobalVariable($varName),
              "$varName should be regognized as global variable");
    } else {
      $this->assertFalse(PHPLanguage::isGlobalVariable($varName),
              "$varName should nat be regognized as global variable");
    }
  }

  public function oopKeywords(): iterable {
    foreach (PHPLanguage::getOopKeywords() as $word) {
      yield [$word, true];
    }
    yield ['if', false];
    yield ['class ', false];
    yield ['namespace', false];
    yield ['__CLASS__', false];
  }

  /**
   * @dataProvider oopKeywords
   * 
   * @param  string $keyWord
   * @param  bool $valid
   * @return void
   */
  public function testOopKeywords(string $keyWord, bool $valid): void {
    if ($valid) {
      $this->assertTrue(PHPLanguage::isOopKeyword($keyWord),
              "Keyword $keyWord should be regognized as OOP keyword");
    } else {
      $this->assertFalse(PHPLanguage::isOopKeyword($keyWord),
              "Keyword $keyWord should not be regognized as OOP keyword");
    }
  }

  public function primitiveTypeNames(): iterable {
    foreach (PHPLanguage::getPrimitiveTypeNames() as $name) {
      yield [$name, true];
    }
    foreach (PHPLanguage::getPseudoTypeNames() as $name) {
      yield [$name, false];
    }
    yield [' if', false];
    yield ['', false];
    yield [' ', false];
    yield ['else if', false];
  }

  /**
   * @dataProvider primitiveTypeNames
   * 
   * @param  string $typeName
   * @param  bool $valid
   * @return void
   */
  public function testPrimitiveTypeNames(string $typeName, bool $valid): void {
    if ($valid) {
      $this->assertTrue(PHPLanguage::isPrimitiveTypeName($typeName),
              "$typeName should be regognized as a primitive type name");
    } else {
      $this->assertFalse(PHPLanguage::isPrimitiveTypeName($typeName),
              "$typeName should not be regognized as a primitive type name");
    }
  }

  public function pseudoTypeNameData(): iterable {
    foreach (PHPLanguage::getPseudoTypeNames() as $name) {
      yield [$name, true];
    }
    foreach (PHPLanguage::getPrimitiveTypeNames() as $name) {
      yield [$name, false];
    }
    yield [' if', false];
    yield ['', false];
    yield [' ', false];
    yield ['else if', false];
  }

  /**
   * @dataProvider pseudoTypeNameData
   * @testdox pseudo types belong to typyname group
   * 
   * @param  string $typeName
   * @param  bool $valid
   * @return void
   */
  public function testPseudoTypeNames(string $typeName, bool $valid): void {
    if ($valid) {
      $this->assertTrue(PHPLanguage::isPseudoTypeName($typeName),
              "$typeName should be regognized as a pseudo type name");
      $this->assertTrue(PHPLanguage::isTypeName($typeName),
              "pseudo type $typeName should be regognized as a type name");
    } else {
      $this->assertFalse(PHPLanguage::isPseudoTypeName($typeName),
              "$typeName should not be regognized as a pseudo type name");
    }
  }

  public function keywordData(): iterable {
    foreach (PHPLanguage::getKeywords() as $name) {
      yield [$name, true];
    }
    foreach (PHPLanguage::getGlobalVariables() as $varName) {
      yield [$varName, false];
    }
    yield [' if', false];
    yield ['', false];
    yield [' ', false];
    yield ['else if', false];
  }

  /**
   * @dataProvider keywordData
   * 
   * @param  string $word
   * @param  bool $valid
   * @return void
   */
  public function testKeywords(string $word, bool $valid): void {
    if ($valid) {
      $this->assertTrue(PHPLanguage::isKeyword($word),
              "$word should be regognized as a keyword");
    } else {
      $this->assertFalse(PHPLanguage::isKeyword($word),
              "$word should not be regognized as a keyword");
    }
  }

  public function testReservedWordMapping(): void {
    $reservedWords = iterator_to_array(PHPLanguage::getReservedWords());
    foreach ($reservedWords as $reservedWord) {
      $this->assertTrue(PHPLanguage::isReservedWord($reservedWord),
              "'$reservedWord' should be regognized as a reserved word");
    }
  }

  public function testKeywordMapping(): void {
    $keywords = iterator_to_array(PHPLanguage::getKeywords());
    foreach ($keywords as $keyword) {
      $this->assertTrue(PHPLanguage::isKeyword($keyword),
              "$keyword should be regognized as a keyword");
    }
  }

  public function reservedWordData(): iterable {
    foreach (PHPLanguage::getReservedWords() as $name) {
      yield [$name, true];
    }
    foreach (PHPLanguage::getGlobalVariables() as $name) {
      yield [$name, false];
    }
    yield ['foo', false];
  }

  /**
   * @dataProvider reservedWordData 
   * 
   * @param  string $word
   * @param  bool $valid
   * @return void
   */
  public function testReservedWords(string $word, bool $valid) {
    if ($valid) {
      $this->assertTrue(PHPLanguage::isReservedWord($word),
              "$word should be regognized as a reserved word");
    } else {
      $this->assertFalse(PHPLanguage::isReservedWord($word),
              "$word should not be regognized as an operator");
    }
  }

  public function operatorData(): iterable {
    foreach (PHPLanguage::getOperators() as $name) {
      yield [$name, true];
    }
    foreach (PHPLanguage::getGlobalVariables() as $name) {
      yield [$name, false];
    }
    yield ['try', false];
    yield [' if', false];
    yield ['', false];
    yield [' ', false];
    yield ['else if', false];
  }

  /**
   * @dataProvider operatorData 
   * 
   * @param  string $operator
   * @param  bool $valid
   * @return void
   */
  public function testOperators(string $operator, bool $valid): void {
    if ($valid) {
      $this->assertTrue(PHPLanguage::isOperator($operator),
              "$operator should be regognized as an operator");
      $this->assertTrue(PHPLanguage::isKeyword($operator),
              "operator '$operator' should be regognized as a keyword");
    } else {
      $this->assertFalse(PHPLanguage::isOperator($operator),
              "$operator should not be regognized as an operator");
    }
  }

  public function magicConstantsData(): iterable {
    foreach (PHPLanguage::getMagicConstants() as $name) {
      yield [$name, true];
    }
    foreach (PHPLanguage::getGlobalVariables() as $name) {
      yield [$name, false];
    }
    yield ['try', false];
    yield [' if', false];
    yield ['', false];
    yield [' ', false];
    yield ['else if', false];
  }

  /**
   * @dataProvider magicConstantsData 
   * 
   * @param  string $constName
   * @param  bool $valid
   * @return void
   */
  public function testMagicConstants(string $constName, bool $valid): void {
    if ($valid) {
      $this->assertTrue(PHPLanguage::isMagicConstant($constName),
              "'$constName' should be regognized as a magic constant name");
    } else {
      $this->assertFalse(PHPLanguage::isMagicConstant($constName),
              "'$constName' should not be regognized as a magic constant name");
    }
  }

}
