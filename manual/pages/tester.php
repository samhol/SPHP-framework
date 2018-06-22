<?php

echo "<pre>";

class UnitTransformer {

  private $unitMap = ['m' => 1, 'cm' => .1, 'km' => 1000];

  /**
   * 
   * @param string $from
   * @return float
   * @throws Sphp\Exceptions\InvalidArgumentException
   */
  public function getFactor(string $from): float {
    if (!array_key_exists($from, $this->unitMap)) {
      throw new Sphp\Exceptions\InvalidArgumentException("$from is not recognised");
    } else {
      return $this->unitMap[$from];
    }
  }

  /**
   * 
   * @param float $value
   * @param string $unit
   * @param string $newUnit
   * @return float
   */
  public function transform(float $value, string $unit, string $newUnit): float {
    return $value * $this->getFactor($unit) / $this->getFactor($newUnit);
  }

}

$foo = new UnitTransformer();
var_dump($foo->transform(1, 'km', 'cm'));
echo "</pre>";
