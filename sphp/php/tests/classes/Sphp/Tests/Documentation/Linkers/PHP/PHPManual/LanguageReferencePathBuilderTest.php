<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP\PHPManual;

use PHPUnit\Framework\TestCase;
use Sphp\Reflection\Utils\PHPWords;
use Sphp\Documentation\Linkers\PHP\PHPManual\LanguageReferencePathBuilder;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;
use Sphp\Reflection\Utils\PHPWord;

/**
 * Class ReservedURLsTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LanguageReferencePathBuilderTest extends TestCase {

  public function wordPathMap(): iterable {
    $wordPathMap = [
        'or' => 'language.operators.logical.php',
        'and' => 'language.operators.logical.php',
        'xor' => 'language.operators.logical.php',
        '__halt_compiler' => 'function.halt-compiler.php',
        'abstract' => 'language.oop5.abstract.php',
        'as' => 'control-structures.foreach.php',
        'break' => 'control-structures.break.php',
        'case' => 'control-structures.case.php',
        'catch' => 'language.exceptions.php#language.exceptions.catch',
        'class' => 'language.oop5.basic.php#language.oop5.basic.class',
        'clone' => 'language.oop5.cloning.php',
        'const' => 'language.oop5.constants.php',
        'continue' => 'control-structures.continue.php',
        'declare' => 'control-structures.declare.php',
        'default' => 'control-structures.default.php',
        'die' => 'function.die.php',
        'do' => 'control-structures.do-while.php',
        'echo' => 'function.echo.php',
        'else' => 'control-structures.else.php',
        'elseif' => 'control-structures.elseif.php',
        'empty' => 'function.empty.php',
        'enddeclare' => 'control-structures.declare.php',
        'endfor' => 'control-structures.for.php',
        'endforeach' => 'control-structures.foreach.php',
        'endif' => 'control-structures.if.php',
        'endswitch' => 'control-structures.switch.php',
        'endwhile' => 'control-structures.while.php',
        'eval' => 'function.eval.php',
        'exit' => 'function.exit.php',
        'extends' => 'language.oop5.basic.php#language.oop5.basic.extends',
        'final' => 'language.oop5.final.php',
        'finally' => 'language.exceptions.php#language.exceptions.finally',
        'fn' => 'function.arrow.php',
        'for' => 'control-structures.for.php',
        'foreach' => 'control-structures.foreach.php',
        'function' => 'reserved.keywords.php',
        'global' => 'language.variables.scope.php#language.variables.scope.global',
        'goto' => 'control-structures.goto.php',
        'if' => 'control-structures.if.php',
        'implements' => 'language.oop5.interfaces.php#language.oop5.interfaces.implements',
        'include' => 'function.include.php',
        'include_once' => 'function.include-once.php',
        'instanceof' => 'language.operators.type.php',
        'insteadof' => 'language.oop5.traits.php#language.oop5.traits.conflict',
        'interface' => 'language.oop5.interfaces.php',
        'isset' => 'function.isset.php',
        'list' => 'function.list.php',
        'match' => 'control-structures.match.php',
        'namespace' => 'language.namespaces.definition.php',
        'new' => 'language.oop5.basic.php#language.oop5.basic.new',
        'print' => 'function.print.php',
        'private' => 'language.oop5.visibility.php',
        'protected' => 'language.oop5.visibility.php',
        'public' => 'language.oop5.visibility.php',
        'require' => 'function.require.php',
        'require_once' => 'function.require-once.php',
        'return' => 'function.return.php',
        'static' => 'language.oop5.static.php',
        'switch' => 'control-structures.switch.php',
        'throw' => 'language.exceptions.php',
        'trait' => 'language.oop5.traits.php',
        'try' => 'language.exceptions.php',
        'unset' => 'function.unset.php',
        'use' => 'language.namespaces.importing.php',
        'var' => 'language.oop5.properties.php',
        'while' => 'control-structures.while.php',
        'yield' => 'language.generators.syntax.php#control-structures.yield',
        'yield from' => 'language.generators.syntax.php#control-structures.yield.from',
        'self' => 'language.types.declarations.php',
        'parent' => 'language.types.declarations.php',
        '__CLASS__' => 'language.constants.magic.php#constant.class',
        '__DIR__' => 'language.constants.magic.php#constant.dir',
        '__FILE__' => 'language.constants.magic.php#constant.file',
        '__FUNCTION__' => 'language.constants.magic.php#constant.function',
        '__LINE__' => 'language.constants.magic.php#constant.line',
        '__METHOD__' => 'language.constants.magic.php#constant.method',
        '__NAMESPACE__' => 'language.constants.magic.php#constant.namespace',
        '__TRAIT__' => 'language.constants.magic.php#constant.trait',
        'array' => 'language.types.array.php',
        'bool' => 'language.types.boolean.php',
        'callable' => 'language.types.callable.php',
        'float' => 'language.types.float.php',
        'int' => 'language.types.integer.php',
        'iterable' => 'language.types.iterable.php',
        'object' => 'language.types.object.php',
        'string' => 'language.types.string.php',
        'true' => 'language.types.boolean.php',
        'false' => 'language.types.boolean.php',
        'resource' => 'language.types.resource.php',
        'void' => 'language.types.declarations.php#language.types.declarations.void',
        'mixed' => 'language.types.declarations.php#language.types.declarations.mixed',
        'numeric' => 'language.types.numeric-strings.php',
        'null' => 'language.types.null.php',
        '__construct' => 'language.oop5.decon.php#language.oop5.decon.constructor',
        '__destruct' => 'language.oop5.decon.php#language.oop5.decon.destructor',
        '__clone' => 'language.oop5.cloning.php#object.clone',
        '__call' => 'language.oop5.overloading.php#object.call',
        '__callStatic' => 'language.oop5.overloading.php#object.callstatic',
        '__get' => 'language.oop5.overloading.php#object.get',
        '__set' => 'language.oop5.overloading.php#object.set',
        '__isset' => 'language.oop5.overloading.php#object.isset',
        '__unset' => 'language.oop5.overloading.php#object.unset',
        '__sleep' => 'language.oop5.magic.php#object.sleep',
        '__wakeup' => 'language.oop5.magic.php#object.wakeup',
        '__serialize' => 'language.oop5.magic.php#object.serialize',
        '__unserialize' => 'language.oop5.magic.php#object.unserialize',
        '__toString' => 'language.oop5.magic.php#object.tostring',
        '__invoke' => 'language.oop5.magic.php#object.invoke',
        '__set_state' => 'language.oop5.magic.php#object.set-state',
        '__debugInfo' => 'language.oop5.magic.php#object.debuginfo',
        '$_SERVER' => 'reserved.variables.server.php',
        '$_GET' => 'reserved.variables.get.php',
        '$_POST' => 'reserved.variables.post.php',
        '$_FILES' => 'reserved.variables.files.php',
        '$_REQUEST' => 'reserved.variables.request.php',
        '$_SESSION' => 'reserved.variables.session.php',
        '$_ENV' => 'reserved.variables.env.php',
        '$_COOKIE' => 'reserved.variables.cookie.php',
        '$php_errormsg' => 'reserved.variables.phperrormsg.php',
        '$HTTP_RAW_POST_DATA' => 'reserved.variables.httprawpostdata.php',
        '$http_response_header' => 'reserved.variables.httpresponseheader.php',
        '$argc' => 'reserved.variables.argc.php',
        '$argv' => 'reserved.variables.argv.php',
    ];
    foreach ($wordPathMap as $name => $path) {
      yield [$name, $path];
    }
  }

  /**
   * @dataProvider wordPathMap
   * 
   * @param  string $name
   * @param  string $excepted
   * @return void
   */
  public function testWordPaths(string $name, string $excepted): void {
    try {
      $instance = new LanguageReferencePathBuilder();
      $this->assertSame($excepted, LanguageReferencePathBuilder::path($name));
      $this->assertSame($excepted, $instance(PHPWords::fullCollection()->getWord($name)));
      //echo "\nKnown word $word: $path";
    } catch (NonDocumentedFeatureException $ex) {
      // echo "\nunknown word: $word\n";
      echo "\n" . $ex->getMessage();
      echo "\nunknown word: $name";
    }
  }

  public function testAllWords(): void {
    foreach (PHPWords::fullCollection() as $word) {
      try {
        $path = LanguageReferencePathBuilder::path($word->getName());
        $this->assertIsString($path);
        //echo "\n'$word' => '$path',";
      } catch (NonDocumentedFeatureException $ex) {
        // echo "\nunknown word: $word\n";
        echo "\n" . $ex->getMessage();
        echo "\nunknown word: $word";
      }
    }
  }

  public function testControlStructures(): void {
    foreach (PHPWords::fullCollection()->filterByType(PHPWord::CONTROL_STRUCTURE) as $word) {
      try {
        $path = LanguageReferencePathBuilder::path($word->getName());
        $this->assertIsString($path);
        //echo "\nControl structure $word: $path";
      } catch (NonDocumentedFeatureException $ex) {
        // echo "\nunknown word: $word\n";
        echo "\n" . $ex->getMessage();
        echo "\nunknown word: $word";
      }
    }
  }

  public function testTypes(): void {
    foreach (PHPWords::fullCollection()->filterByType(PHPWord::TYPE) as $word) {
      try {
        $path = LanguageReferencePathBuilder::path($word->getName());
        $this->assertIsString($path);
       // echo "\n$word: $path";
      } catch (NonDocumentedFeatureException $ex) {
        // echo "\nunknown word: $word\n";
        echo "\n" . $ex->getMessage();
        echo "\nunknown word: $word";
      }
    }
  }

  public function testSoftReservedWords(): void {
    foreach (PHPWords::fullCollection()->filterByType(PHPWord::SOFT_RESERVED_WORD) as $word) {
      try {
        $path = LanguageReferencePathBuilder::path($word->getName());
        $this->assertIsString($path);
        //echo "\n$word: $path";
      } catch (NonDocumentedFeatureException $ex) {
        // echo "\nunknown word: $word\n";
        echo "\n" . $ex->getMessage();
        echo "\nunknown word: $word";
      }
    }
  }

}
