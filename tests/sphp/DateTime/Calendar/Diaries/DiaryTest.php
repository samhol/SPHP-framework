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
use Sphp\DateTime\Calendars\Diaries\Diary;

/**
 * Description of DiaryTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DiaryTest extends TestCase {

  /**
   * @var Diary
   */
  private $diary;

  protected function setUp() {
    $this->diary = new Diary();
  }

  protected function tearDown() {
    unset($this->diary);
  }

  public function testConstructor() {
    $diary = new Diary();
    $this->assertFalse($diary->notEmpty());
  }

}
