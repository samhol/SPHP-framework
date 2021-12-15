<?php

namespace Sphp\Tests\Foo;

const FOO_CONST = 100;
const ANOTHER_CONST = 'foo';

function func1(?int $bar, string $baz = 'foobar'): void {
  echo "$baz: $bar";
}

function foo(?int $bar, string $baz = 'foobar'): void {
  
}

trait BarTrait {

  public $barTraitInstance;

}

trait FooTrait {
  
}
/**
 * Dummy interface
 */
interface AnInterface extends \Countable {

  /**
   * public constant
   */
  public const PUBLIC_CONST = 'public';
  public const lowercase = 'lowercase_const';

  /**
   * Some function 
   * 
   * @return string
   */
  public function fromInterface(): string;
}

abstract class AbstractClass implements AnInterface {

  use FooTrait;

  protected const PROTECTED_CONST = 'protected';

  protected function protectedFunction(string $param = null): ?string {
    return $param;
  }

}

class Foo {

  public $bar = 'foobar';

}

class Instantiable extends AbstractClass {

  private const PRIVATE_CONST = 'private';

  public string $bar = 'foobar';
  private string $lowercase;
  
  public static string $staticProperty = 'foo';

  /**
   * @var Foo 
   */
  public $foo;

  /**
   * Constructor
   * 
   * @param Foo|null $foo
   */
  public function __construct(?Foo $foo = null) {
    $this->lowercase = 'lowercase';
    if ($foo === null) {
      $foo = new Foo();
    }
    $this->foo = $foo;
  }

  public function __destruct() {
    unset($this->foo);
  }

  public function __clone() {
    $this->foo = clone $this->foo;
  }

  public function getFoo(): Foo {
    return $this->foo;
  }

  public function baz(int $bar): void {
    
  }

  public function setFoo(Foo $foo) {
    $this->foo = $foo;
    return $this;
  }

  public static function staticFunction(int $x): string {
    return $this->lowercase;
  }

  public function fromInterface(): string {
    return $this->lowercase;
  }

  public function lowercase(): string {
    return $this->lowercase;
  }

  public function count(): int {
    return 4;
  }

}

final class FinalClass extends Instantiable {
  
}
