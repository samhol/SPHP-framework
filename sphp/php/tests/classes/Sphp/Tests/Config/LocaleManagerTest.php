<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Config;

use PHPUnit\Framework\TestCase;
use Sphp\Config\LocaleManager;
use Sphp\Config\Exception\ConfigurationException;

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
    try {
      $original = setlocale(LC_CTYPE, '0');
      $this->assertSame($localeMngr, $localeMngr->setLocale(LC_CTYPE, 'nld_nld'));
      $this->assertSame(setlocale(LC_CTYPE, '0'), LocaleManager::getLocale(LC_CTYPE));
      $this->assertSame($localeMngr, $localeMngr->restoreLocales(LC_CTYPE));
      $this->assertSame($original, LocaleManager::getLocale(LC_CTYPE));
    } catch (ConfigurationException $ex) {
      echo $ex;
    }
  }

  public function testSettingFailure(): void {
    $localeMngr = new LocaleManager();
    $this->expectException(ConfigurationException::class);
    $localeMngr->setLocale(LC_ALL, 'LC_FOO=bar');
  }

  public function testGettingFailure(): void {
    $this->expectException(ConfigurationException::class);
    LocaleManager::getLocale(6);
  }

  public function testRestoringFailure(): void {
    $localeMngr = new LocaleManager();
    $localeMngr->setLocale(\LC_TIME, 'american english', 'en_US.utf-6');
    $this->assertSame(setlocale(LC_TIME, '0'), LocaleManager::getLocale(LC_TIME));
    $this->expectException(ConfigurationException::class);
    $localeMngr->restoreLocales(6);
  }

  public function testRun(): void {
    $localeMngr = new LocaleManager();
    $f = function () {
      $this->assertSame("vrijdag 22 december 1978", strftime("%A %e %B %Y", mktime(0, 0, 0, 12, 22, 1978)));
    };
    try {
      $this->assertSame($localeMngr, $localeMngr->run($f, LC_ALL, 'nld_nld'));
    } catch (\Exception $ex) {
      //$this->assertInstanceOf(ConfigurationException::class, $ex);
      echo $ex;
    }
  }

}
