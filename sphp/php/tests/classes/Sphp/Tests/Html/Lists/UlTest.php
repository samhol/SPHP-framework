<?php

declare(strict_types=1);

namespace Sphp\Tests\Html\Lists;

use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\StandardList;

class UlTest extends StandardListTest {

  public function createList(iterable $value = null): StandardList {
    return new Ul($value);
  }

}
