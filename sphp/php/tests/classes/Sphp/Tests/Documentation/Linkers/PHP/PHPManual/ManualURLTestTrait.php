<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP\PHPManual;

use Sphp\Documentation\Linkers\PHP\PHPManual\ManualURL;

/**
 * Trait ManualURLTestTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
trait ManualURLTestTrait {

  abstract public function createManualURL(string $lang = 'en'): ManualURL;

  public function laguages(): array {
    $output = [];
    $output[] = ['en'];
    $output[] = ['pt_BR'];
    return $output;
  }

  /**
   * @dataProvider laguages
   * 
   * @param  string $lang
   * @return void
   */
  public function testLanguageSetting(string $lang): void {
    $phpURL = $this->createManualURL($lang);
    $this->assertEquals('https://www.php.net/manual/' . $lang . '/', $phpURL->getRootUrl());
    $this->assertEquals($lang, $phpURL->getLanguage());
    $phpURL1 = $this->createManualURL('foo');
    $phpURL1->setLanguage($lang);
    $this->assertEquals($phpURL->getRootUrl(), $phpURL1->getRootUrl());
    $this->assertEquals($lang, $phpURL1->getLanguage());
  }

}
