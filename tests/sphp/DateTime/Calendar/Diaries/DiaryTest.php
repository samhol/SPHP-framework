<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime\Calendar\Diaries;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Calendars\Diaries\MutableDiary;
  
class DiaryTest extends TestCase {

  public function testConstructor() {
    $diary = new MutableDiary();
    $this->assertFalse($diary->notEmpty());
  }

}
