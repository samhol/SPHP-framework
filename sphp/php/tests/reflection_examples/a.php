<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace A\B;

const C_1 = 1;

function f(string $str = null, int $int = 0, \stdClass $obj = null): ?\stdClass {
  return $obj;
}

interface I {

  const C_I = 'C_I';

  public function f1();

  public function f3();
}

trait T1 {

  function ft1() {
    
  }

}

trait T2 {

  function ft2() {
    
  }

}

trait T3 {

  public static $sp1;

  function ft3() {
    
  }

}

abstract class AC {

  use T1;

  public const C_AC = 'C_AC';

  public static $sp2;
  protected $p1;

  abstract protected function f2();

  public function f3() {
    
  }

  public static function sf1() {
    
  }

}

class C extends AC implements I {

  public const C_C = 'C_C';

  public $p2;

  use T1,
      T2,
      T3;

  public function f1() {
    
  }

  public function f2() {
    
  }

  public function f3() {
    
  }

  public static function sf2() {
    
  }

}
