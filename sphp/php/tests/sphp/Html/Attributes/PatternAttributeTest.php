<?php

declare(strict_types=1);

namespace Sphp\Tests\Html\Attributes;

use Sphp\Tests\Html\Attributes\AbstractScalarAttributeTest;
use Sphp\Html\Attributes\MutableAttribute;
use Sphp\Html\Attributes\PatternAttribute;

class PatternAttributeTest extends AbstractScalarAttributeTest {

  /**
   * @return MutableAttribute
   */
  public function createAttr(string $name = 'data-attr', string $pattern = '/^[^a]+$/'): MutableAttribute {
    return new PatternAttribute($name, $pattern);
  }

  public function basicInvalidValues(): array {
    return [
        [new \stdClass],
        ['a']
    ];
  }

  public function basicValidValues(): array {
    return [
        ['yes', 'yes'],
        [1, 1],
        [0, 0],
        [' ', ' '],
    ];
  }

}
