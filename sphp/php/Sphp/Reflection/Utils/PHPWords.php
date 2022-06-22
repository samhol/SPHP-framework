<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Reflection\Utils;

use Iterator;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Class PHPLanguageWords
 *
 * @method bool isOop(string $word) Checks if the word name is OOP
 * @method bool isControlStructure(string $word) Checks if the word is a control structure
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PHPWords implements Iterator {

  private array $data = [
      /**
       * logical operators 
       */
      'or' => PHPWord::LOGIGAL_OPERATOR | PHPWord::KEYWORD,
      'and' => PHPWord::LOGIGAL_OPERATOR | PHPWord::KEYWORD,
      'xor' => PHPWord::LOGIGAL_OPERATOR | PHPWord::KEYWORD,
      /**
       * keywords
       */
      '__halt_compiler' => PHPWord::KEYWORD,
      'abstract' => PHPWord::OOP | PHPWord::KEYWORD,
      'as' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'break' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'case' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'catch' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'class' => PHPWord::OOP | PHPWord::KEYWORD,
      'clone' => PHPWord::OOP | PHPWord::KEYWORD,
      'const' => PHPWord::KEYWORD,
      'continue' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'declare' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'default' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'die' => PHPWord::KEYWORD,
      'do' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'echo' => PHPWord::KEYWORD,
      'else' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'elseif' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'empty' => PHPWord::KEYWORD,
      'enddeclare' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'endfor' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'endforeach' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'endif' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'endswitch' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'endwhile' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'eval' => PHPWord::KEYWORD,
      'exit' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'extends' => PHPWord::OOP | PHPWord::KEYWORD,
      'final' => PHPWord::OOP | PHPWord::KEYWORD,
      'finally' => PHPWord::OOP | PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'fn' => PHPWord::KEYWORD,
      'for' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'foreach' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'function' => PHPWord::KEYWORD,
      'global' => PHPWord::KEYWORD,
      'goto' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'if' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'implements' => PHPWord::OOP | PHPWord::KEYWORD,
      'include' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'include_once' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'instanceof' => PHPWord::OOP | PHPWord::KEYWORD | PHPWord::OPERATOR,
      'insteadof' => PHPWord::OOP | PHPWord::KEYWORD | PHPWord::OPERATOR,
      'interface' => PHPWord::OOP | PHPWord::KEYWORD,
      'isset' => PHPWord::KEYWORD,
      'list' => PHPWord::KEYWORD,
      'match' => PHPWord::KEYWORD,
      'namespace' => PHPWord::KEYWORD,
      'new' => PHPWord::OOP | PHPWord::KEYWORD,
      'print' => PHPWord::KEYWORD,
      'private' => PHPWord::OOP | PHPWord::KEYWORD,
      'protected' => PHPWord::OOP | PHPWord::KEYWORD,
      'public' => PHPWord::OOP | PHPWord::KEYWORD,
      'require' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'require_once' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'return' => PHPWord::KEYWORD,
      'static' => PHPWord::OOP | PHPWord::KEYWORD,
      'switch' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'throw' => PHPWord::OOP | PHPWord::KEYWORD,
      'trait' => PHPWord::OOP | PHPWord::KEYWORD,
      'try' => PHPWord::OOP | PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'unset' => PHPWord::KEYWORD,
      'use' => PHPWord::KEYWORD | PHPWord::OPERATOR,
      'var' => PHPWord::OOP | PHPWord::KEYWORD,
      'while' => PHPWord::KEYWORD | PHPWord::CONTROL_STRUCTURE,
      'yield' => PHPWord::KEYWORD,
      'yield from' => PHPWord::KEYWORD,
      'self' => PHPWord::OOP,
      'parent' => PHPWord::OOP,
      /**
       * Magic constants
       */
      '__CLASS__' => PHPWord::MAGIC_CONST,
      '__DIR__' => PHPWord::MAGIC_CONST,
      '__FILE__' => PHPWord::MAGIC_CONST,
      '__FUNCTION__' => PHPWord::MAGIC_CONST,
      '__LINE__' => PHPWord::MAGIC_CONST,
      '__METHOD__' => PHPWord::MAGIC_CONST,
      '__NAMESPACE__' => PHPWord::MAGIC_CONST,
      '__TRAIT__' => PHPWord::MAGIC_CONST,
      /**
       * Type related words
       */
      'array' => PHPWord::KEYWORD | PHPWord::PRIMITIVE_TYPE,
      'bool' => PHPWord::RESERVED_WORD | PHPWord::PRIMITIVE_TYPE,
      'callable' => PHPWord::KEYWORD | PHPWord::PRIMITIVE_TYPE,
      'float' => PHPWord::RESERVED_WORD | PHPWord::PRIMITIVE_TYPE,
      'int' => PHPWord::RESERVED_WORD | PHPWord::PRIMITIVE_TYPE,
      'iterable' => PHPWord::OOP | PHPWord::PSEUDO_TYPE,
      'object' => PHPWord::KEYWORD | PHPWord::OOP_TYPE,
      'string' => PHPWord::RESERVED_WORD | PHPWord::PRIMITIVE_TYPE,
      'void' => PHPWord::RESERVED_WORD | PHPWord::PRIMITIVE_TYPE,
      'true' => PHPWord::RESERVED_WORD | PHPWord::PRIMITIVE_TYPE,
      'false' => PHPWord::RESERVED_WORD | PHPWord::PRIMITIVE_TYPE,
      'resource' => PHPWord::SOFT_RESERVED_WORD | PHPWord::PRIMITIVE_TYPE,
      'mixed' => PHPWord::SOFT_RESERVED_WORD | PHPWord::PSEUDO_TYPE,
      'numeric' => PHPWord::SOFT_RESERVED_WORD | PHPWord::PSEUDO_TYPE,
      'true' => PHPWord::RESERVED_WORD,
      'false' => PHPWord::RESERVED_WORD,
      'null' => PHPWord::SOFT_RESERVED_WORD | PHPWord::PRIMITIVE_TYPE,
      /**
       * Magic method names
       */
      '__construct' => PHPWord::MAGIC_METHOD,
      '__destruct' => PHPWord::MAGIC_METHOD,
      '__clone' => PHPWord::MAGIC_METHOD,
      '__call' => PHPWord::MAGIC_METHOD,
      '__callStatic' => PHPWord::MAGIC_METHOD,
      '__get' => PHPWord::MAGIC_METHOD,
      '__set' => PHPWord::MAGIC_METHOD,
      '__isset' => PHPWord::MAGIC_METHOD,
      '__unset' => PHPWord::MAGIC_METHOD,
      '__sleep' => PHPWord::MAGIC_METHOD,
      '__wakeup' => PHPWord::MAGIC_METHOD,
      '__serialize' => PHPWord::MAGIC_METHOD,
      '__unserialize' => PHPWord::MAGIC_METHOD,
      '__toString' => PHPWord::MAGIC_METHOD,
      '__invoke' => PHPWord::MAGIC_METHOD,
      '__set_state' => PHPWord::MAGIC_METHOD,
      '__debugInfo' => PHPWord::MAGIC_METHOD,
      /**
       * Predefined global variables
       */
      '$_SERVER' => PHPWord::PREDEFINED_VAR,
      '$_GET' => PHPWord::PREDEFINED_VAR,
      '$_POST' => PHPWord::PREDEFINED_VAR,
      '$_FILES' => PHPWord::PREDEFINED_VAR,
      '$_REQUEST' => PHPWord::PREDEFINED_VAR,
      '$_SESSION' => PHPWord::PREDEFINED_VAR,
      '$_ENV' => PHPWord::PREDEFINED_VAR,
      '$_COOKIE' => PHPWord::PREDEFINED_VAR,
      '$php_errormsg' => PHPWord::PREDEFINED_VAR,
      '$HTTP_RAW_POST_DATA' => PHPWord::PREDEFINED_VAR,
      '$http_response_header' => PHPWord::PREDEFINED_VAR,
      '$argc' => PHPWord::PREDEFINED_VAR,
      '$argv' => PHPWord::PREDEFINED_VAR,
  ];

  public function __construct(array $data = null) {
    if ($data === null) {
      foreach ($this->data as $key => $type) {
        $this->data[$key] = new PHPWord($key, $type);
      }
    } else {
      $this->data = $data;
    }
    // print_r($this->data);
  }

  public function __destruct() {
    unset($this->data);
  }

  /**
   * MAgic call implementation
   * 
   * @param  string $name
   * @param  array $arguments
   * @return bool
   * @throws BadMethodCallException
   */
  public function __call(string $name, array $arguments): bool {
    if (!str_starts_with($name, 'is') || !method_exists(PHPWord::class, $name)) {
      throw new BadMethodCallException("Bad Method call $name");
    }
    if (count($arguments) !== 1) {
      throw new BadMethodCallException("Invalid number of arguments for $name-method");
    }
    if (!is_string($arguments[0])) {
      throw new BadMethodCallException("Argument passed to must be of the type string");
    }
    if (!$this->containsWord(...$arguments)) {
      $out = false;
    } else {
      $out = $this->getWord(...$arguments)->$name();
    }
    return $out;
  }

  /**
   * 
   * @param  int $type
   * @return PHPWords
   */
  public function filterByType(int $type): PHPWords {
    $callback = function (PHPWord $word) use ($type): bool {
      return $word->is($type);
    };
    return new self(array_filter($this->data, $callback));
  }

  /**
   * Returns the current element
   * 
   * @return PHPWord the current element
   */
  public function current(): mixed {
    return current($this->data);
  }

  /**
   * Advance the internal pointer of the collection
   *
   * @return void
   */
  public function next(): void {
    next($this->data);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key(): mixed {
    return key($this->data);
  }

  /**
   * Rewinds the Iterator to the first element
   *
   * @return void
   */
  public function rewind(): void {
    reset($this->data);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return bool current if iterator position is valid
   */
  public function valid(): bool {
    return null !== key($this->data);
  }

  public function containsWord(string $name): bool {
    return array_key_exists($name, $this->data);
  }

  /**
   * 
   * @param  string $name
   * @return PHPWord|null
   */
  public function getWord(string $name): ?PHPWord {
    return $this->containsWord($name) ? $this->data[$name] : null;
  }

  private static ?PHPWords $instance = null;

  public static function fullCollection(): PHPWords {
    if (self::$instance === null) {
      self::$instance = new PHPWords();
    }
    return self::$instance;
  }

}
