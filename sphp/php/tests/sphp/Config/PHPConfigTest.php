<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config;

use PHPUnit\Framework\TestCase;

/**
 * Implementation of PHPConfigTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PHPConfigTest extends TestCase {

  protected function setUp(): void {

    parent::setUp();
    if (!defined('LC_MESSAGES')) {
      define('LC_MESSAGES', 5);
    }
  }

  public function testSuccessful() {

    $localeMngr = new LocaleManager();
    $this->assertSame($localeMngr, $localeMngr->setLocale(LC_ALL, 'nl_NL'));
    $this->assertSame('nl_NL', setlocale(LC_ALL, '0'));
    $this->assertSame('nl_NL', $localeMngr->getLocale(LC_ALL));
    $this->assertSame($localeMngr, $localeMngr->setLocale(LC_ALL, 'fi_FI'));
    $this->assertSame('fi_FI', setlocale(LC_ALL, '0'));
    $this->assertSame('fi_FI', $localeMngr->getLocale(LC_ALL));
  }

  public function testFailure() {
    $localeMngr = new LocaleManager();
    $this->expectException(Exception\ConfigurationException::class);
    $localeMngr->setLocale(LC_ALL, '  ');
  }

  public function data(): array {
    if (!defined('LC_MESSAGES')) {
      define('LC_MESSAGES', 5);
    }
    $localeMap = [];
    $localeMap[] = ['All', LC_ALL, ['de_DE@euro', 'de_DE', 'deu_deu']]; // for all of the below
    $localeMap[] = ['Collate', LC_COLLATE]; // for string comparison, see strcoll()
    $localeMap[] = ['Ctype', LC_CTYPE]; // for character classification and conversion, for example strtoupper()
    $localeMap[] = ['Monetary', LC_MONETARY]; // for localeconv()
    $localeMap[] = ['Numeric', LC_NUMERIC]; // for decimal separator(See also localeconv())
    $localeMap[] = ['Time', LC_TIME]; // for date and time formatting with strftime()
    $localeMap[] = ['Messages', LC_MESSAGES]; // for system responses (available if PHP was compiled with libintl);
    return $localeMap;
  }

  /**
   * @dataProvider data
   * @param string $what
   * @param int $constant
   */
  public function dtestSparateCategories(string $what, int $constant) {
    $localeMngr = new LocaleManager();
    $this->assertSame($localeMngr, $localeMngr->{"set$what"}('en_US'), "set$what::");
  }

}
