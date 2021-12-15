<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\I18n;

use PHPUnit\Framework\TestCase;
use Sphp\I18n\Datetime\DateFormatter;

/**
 * The DateFormatterTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateFormatterTest extends TestCase {

  /**
   * @return void
   */
  public function testFormatters(): void {
    $formatter = new DateFormatter(new \DateTimeImmutable('2000-9-16'));
    $this->assertSame($formatter, $formatter->setLocale('en_US.utf-8'));
    $this->assertSame('September 16.', $formatter->formatICU('MMMM d.', 'en_US.utf-8'));
    $this->assertSame($formatter, $formatter->setLocale('fi_FI.utf-8'));
    $this->assertSame('16. syyskuuta', $formatter->formatICU('d. MMMM', 'fi_FI.utf-8'));
  }

  /**
   * @return void
   */
  public function testMonthName(): void {
    $formatter = new DateFormatter(new \DateTimeImmutable('2000-9-16'));
    $this->assertSame($formatter, $formatter->setLocale('en_US.utf-8'));
    $this->assertSame('September', $formatter->getMonthName());
    $this->assertSame('Sep', $formatter->getMonthName(3));
    $this->assertSame($formatter, $formatter->setLocale('fi_FI.utf-8'));
    $this->assertSame('syy', $formatter->getMonthName(3));
  }

  /**
   * @return void
   */
  public function testWeekdayName(): void {
    $formatter = new DateFormatter(new \DateTimeImmutable('last monday'));
    $this->assertSame($formatter, $formatter->setLocale('en_US.utf-8'));
    $this->assertSame('Monday', $formatter->getWeekdayName());
    $this->assertSame('Mon', $formatter->getWeekdayName(3));
    $this->assertSame($formatter, $formatter->setLocale('fi_FI.utf-8'));
    $this->assertSame('maa', $formatter->getWeekdayName(3));
  }

  /**
   * @return void
   */
  public function testOtherGetters(): void {
    $formatter = new DateFormatter(new \DateTimeImmutable('2021-09-01'));
    $this->assertSame(35, $formatter->getWeekOfYear());
    $this->assertSame(244, $formatter->getDayOfYear());
  }

  /**
   * @return void
   */
  public function testStrftime(): void {
    $formatter = new DateFormatter(new \DateTimeImmutable('last Monday'));
    $this->assertSame('Monday', $formatter->strftime('%A'));
    $this->assertSame($formatter, $formatter->setLocale('finnish'));
    $this->assertSame('maanantai', $formatter->strftime('%A'));
  }

}
