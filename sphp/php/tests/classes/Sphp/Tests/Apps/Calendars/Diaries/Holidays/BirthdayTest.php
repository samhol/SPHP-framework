<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Calendars\Diaries\Holidays;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\ImmutableDate;
use Sphp\Apps\Calendars\Diaries\Holidays\BirthDay;

/**
 * The BirthdayTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BirthdayTest extends TestCase {

  public function testAlive(): void {
    $dob = ImmutableDate::from('1975-9-6');
    $birthday = new BirthDay($dob, 'Sami Holck');
    $this->assertEquals('Sami Holck', $birthday->getName());
    $this->assertEquals($dob, $birthday->getDateOfBirth());
    $this->assertNull($birthday->getDateOfDeath());
    $this->assertEquals($dob->diff(ImmutableDate::now()), $birthday->getAge());
    $this->assertFalse($birthday->isDead());
  }

  public function testDead(): void {
    $dob = ImmutableDate::from('1865-12-8');
    $dod = ImmutableDate::from('1957-9-20');
    $birthday = new BirthDay($dob, 'Jean Sibelius', $dod);
    $this->assertEquals('Jean Sibelius', $birthday->getName());
    $this->assertEquals($dob, $birthday->getDateOfBirth());
    $this->assertEquals($dod, $birthday->getDateOfDeath());
    $this->assertEquals($dob->diff($dod), $birthday->getAge());
    $this->assertTrue($birthday->isDead());
  }

}
