<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP\PHPManual;

use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;
use Sphp\Documentation\Linkers\PHP\PHPManual\URLUtils;
use Sphp\Reflection\Utils\PHPWords;
use Sphp\Reflection\Utils\PHPWord;

/**
 * Class TypePathBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
final class LanguageReferencePathBuilder {

  private const VAR_TYPE_PATH = 'language.types.%s.php';
  private const CONTROL_PATH = 'control-structures.%s.php';
  private const FUNCTION_PATH = 'function.%s.php';

  private static array $aliases = [
      'do' => 'do-while',
      'as' => 'foreach',
      'int' => 'integer',
      'double' => 'float',
      'bool' => 'boolean',
      'fn' => 'arrow'
  ];
  private static array $functions = [
      'include', 'include_once',
      'require', 'require_once',
      '__halt_compiler', 'die', 'exit',
      'list', 'echo', 'eval', 'print',
      'arrow',
      'unset', 'isset', 'empty'
  ];

  /**
   * @var string[]
   */
  private static array $wordPathMap = [
      '__construct' => 'language.oop5.decon.php#language.oop5.decon.constructor',
      '__destruct' => 'language.oop5.decon.php#language.oop5.decon.destructor',
      '__clone' => 'language.oop5.cloning.php#object.clone',
      '__sleep' => 'language.oop5.magic.php#object.sleep',
      '__wakeup' => 'language.oop5.magic.php#object.wakeup',
      '__serialize' => 'language.oop5.magic.php#object.serialize',
      '__unserialize' => 'language.oop5.magic.php#object.unserialize',
      '__debugInfo' => 'language.oop5.magic.php#object.debuginfo',
      '__set_state' => 'language.oop5.magic.php#object.set-state',
      '__invoke' => 'language.oop5.magic.php#object.invoke',
      '__toString' => 'language.oop5.magic.php#object.tostring',
      '__call' => 'language.oop5.overloading.php#object.call',
      '__callStatic' => 'language.oop5.overloading.php#object.callstatic',
      '__get' => 'language.oop5.overloading.php#object.get',
      '__set' => 'language.oop5.overloading.php#object.set',
      '__unset' => 'language.oop5.overloading.php#object.unset',
      '__isset' => 'language.oop5.overloading.php#object.isset',
      'function' => 'reserved.keywords.php',
      'implements' => 'language.oop5.interfaces.php#language.oop5.interfaces.implements',
      'insteadof' => 'language.oop5.traits.php#language.oop5.traits.conflict',
      'class' => 'language.oop5.basic.php#language.oop5.basic.class',
      'extends' => 'language.oop5.basic.php#language.oop5.basic.extends',
      'new' => 'language.oop5.basic.php#language.oop5.basic.new',
      'abstract' => 'language.oop5.abstract.php',
      'clone' => 'language.oop5.cloning.php',
      'const' => 'language.oop5.constants.php',
      'var' => 'language.oop5.properties.php',
      'final' => 'language.oop5.final.php',
      'interface' => 'language.oop5.interfaces.php',
      'private' => 'language.oop5.visibility.php',
      'protected' => 'language.oop5.visibility.php',
      'public' => 'language.oop5.visibility.php',
      'static' => 'language.oop5.static.php',
      'trait' => 'language.oop5.traits.php',
      'throw' => 'language.exceptions.php',
      'try' => 'language.exceptions.php',
      'catch' => 'language.exceptions.php#language.exceptions.catch',
      'finally' => 'language.exceptions.php#language.exceptions.finally',
      'yield' => 'language.generators.syntax.php#control-structures.yield',
      'yield from' => 'language.generators.syntax.php#control-structures.yield.from',
      'instanceof' => 'language.operators.type.php',
      'namespace' => 'language.namespaces.definition.php',
      'use' => 'language.namespaces.importing.php',
      'global' => 'language.variables.scope.php#language.variables.scope.global',
      'true' => 'language.types.boolean.php',
      'false' => 'language.types.boolean.php',
      'return' => 'function.return.php',
      'match' => 'control-structures.match.php',
      'numeric' => 'language.types.numeric-strings.php',
      'self' => 'language.types.declarations.php',
      'parent' => 'language.types.declarations.php',
      'void' => 'language.types.declarations.php#language.types.declarations.void',
      'mixed' => 'language.types.declarations.php#language.types.declarations.mixed',
  ];

  /**
   * 
   * @param  string|PHPWord $object
   * @return string
   * @throws NonDocumentedFeatureException
   */
  public function __invoke($object): string {
    if (is_string($object)) {
      $object = PHPWords::fullCollection()->getWord($word);
    }
    if ($object === null) {
      throw new NonDocumentedFeatureException("'$word' is not a PHP language construct");
    }
    $word = $object->getName();

    if (array_key_exists($word, self::$aliases)) {
      $word = self::$aliases[$word];
    }
    if (array_key_exists($word, self::$wordPathMap)) {
      $out = self::$wordPathMap[$word];
    } else if (in_array($word, self::$functions)) {
      $out = $this->buildFunctionPath($word);
    } else if ($object->isTypeName()) {
      $out = $this->buildTypePath($object);
    } else if ($object->isControlStructure()) {
      $out = $this->buildControlStructurePath($word);
    } else if ($object->isMagicConstantName()) {
      $out = $this->buildMagicConstantPath($word);
    } else if ($object->isMagicMethodName()) {
      $out = self::$wordPathMap[$word];
    } else if ($object->isLogicalOperator()) {
      $out = 'language.operators.logical.php';
    } else if ($object->isVariable()) {
      $out = $this->buildVariablePath($word);
    } else {
      throw new NonDocumentedFeatureException("'$word' is not a PHP language construct");
    }
    return $out;
  }

  private function buildMagicConstantPath(string $constant): string {
    return 'language.constants.magic.php#constant.'
            . URLUtils::parseMagicName($constant);
  }

  private function buildTypePath(PHPWord $typeName): string {

    $urlTemplate = self::VAR_TYPE_PATH;
    $name = $typeName->getName();
    if (array_key_exists($name, self::$aliases)) {
      $name = self::$aliases[$name];
    }
    return sprintf($urlTemplate, $name);
  }

  private function buildVariablePath(string $varName): string {
    $cleanName = strtolower(str_replace(['$', '_'], '', $varName));
    return sprintf('reserved.variables.%s.php', $cleanName);
  }

  private function buildFunctionPath(string $function): string {
    $fname = URLUtils::parseFunctionName($function);
    return sprintf(self::FUNCTION_PATH, $fname);
  }

  /**
   * 
   * @param  string $controlStructure
   * @return string
   */
  private function buildControlStructurePath(string $controlStructure): string {
    $cleanName = str_replace(['end'], '', $controlStructure);
    return sprintf(self::CONTROL_PATH, $cleanName);
  }

  private static ?self $instance = null;

  /**
   * Returns the path
   * 
   * @param  string $word
   * @return string the path
   */
  public static function path(string $word): string {
    $object = PHPWords::fullCollection()->getWord($word);
    if ($object === null) {
      throw new NonDocumentedFeatureException("'$word' is not a PHP language construct");
    }
    if (self::$instance === null) {
      self::$instance = new self();
    }
    $builder = self::$instance;
    return $builder($object);
  }

}
