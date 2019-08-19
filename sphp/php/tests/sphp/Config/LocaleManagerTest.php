<?php

declare(strict_types=1);

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
class LocaleManagerTest extends TestCase {

  public function testSuccessful(): void {
    $localeMngr = new LocaleManager();
    $locales = $localeMngr->__toString();
    $this->assertSame($localeMngr, $localeMngr->setLocale('nl_NL.utf8'));
    $this->assertSame('nl_NL.utf8', setlocale(LC_ALL, 0));
    $this->assertSame('nl_NL.utf8', $localeMngr->getLocale('LC_ALL'));
    $this->assertSame($localeMngr, $localeMngr->setLocale('fi_FI.utf8'));
    $this->assertSame('fi_FI.utf8', setlocale(LC_ALL, 0));
    $this->assertSame('fi_FI.utf8', $localeMngr->getLocale('LC_ALL'));
    $this->assertSame($localeMngr, $localeMngr->restoreLocales());
    $this->assertSame($locales, (string) $localeMngr);
  }

  public function testSettingFailure(): void {
    $localeMngr = new LocaleManager();
    $this->expectException(Exception\ConfigurationException::class);
    $localeMngr->setLocale('LC_FOO=bar');
  }
  public function testGettingFailure(): void {
    $localeMngr = new LocaleManager();
    $this->expectException(Exception\ConfigurationException::class);
    $localeMngr->getLocale('LC_FOO');
  }

  public function testRun(): void {
    $localeMngr = new LocaleManager();
    $locales = (string) $localeMngr;
    $translator = function () {
      bindtextdomain("Sphp.Datetime", "./sphp/locale");
      textdomain("Sphp.Datetime");
      $this->assertSame("Valitse päivämäärä ja kellonaika", gettext("Select a Date and Time"));
    };
    try {
      $this->assertSame($localeMngr, $localeMngr->run($translator, 'fi_FI'));
    } catch (\Exception $ex) {
      $this->assertInstanceOf(Exception\ConfigurationException::class, $ex);
      $this->assertSame($locales, (string) $localeMngr);
    }
  }

}
