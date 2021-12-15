<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Calendars\Diaries;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\Calendars\Diaries\BasicLog;
use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\Constraints\Constraints;
use Sphp\DateTime\Constraints\Factory;
/**
 * Class MutableLogTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MutableLogTest extends TestCase {

  public function constructorParams() {
    $params = [];
    $params[] = ['foo', 'bar'];
    $params[] = ['foo', null];
    return $params;
  }

  /**
   * @dataProvider constructorParams
   *  
   * @param  string $name
   * @param  string|null $descrption
   * @return void
   */
  public function testConstructor(string $name, ?string $descrption): void {
    $constraint = Factory::instance()->unique('2000-1-1');
    $entry = new BasicLog($constraint, $name, $descrption);
    $this->assertTrue($entry->dateMatchesWith(ImmutableDate::from('2000-1-1')));
    $this->assertFalse($entry->dateMatchesWith(ImmutableDate::from('2000-1-2')));
    $this->assertFalse($entry->dateMatchesWith(ImmutableDate::from('1999-12-31')));
    $this->assertSame($name, $entry->getName());
    $this->assertSame($descrption, $entry->getDescription());
    $this->assertSame(null, $entry->getData());
  }

  /**
   * @dataProvider constructorParams
   *  
   * @param  string $name
   * @param  string|null $descrption
   * @return void
   */
  public function testSetters(string $name, ?string $descrption): void {
    $constraint = Factory::instance()->anyOfDates('2000-1-1');
    $entry = new BasicLog($constraint, $name, $descrption);
    $this->assertSame($entry, $entry->setName('foo-bar'));
    $this->assertSame('foo-bar', $entry->getName());
    $this->assertSame($entry, $entry->setDescription('foo-bar-baz'));
    $this->assertSame('foo-bar-baz', $entry->getDescription());
    $this->assertSame($entry, $entry->setDescription(null));
    $this->assertSame(null, $entry->getDescription());
    $this->assertSame(null, $entry->getData());
    $this->assertSame($entry, $entry->setData($data = new \stdClass()));
    $this->assertSame($data, $entry->getData());
  }

}
