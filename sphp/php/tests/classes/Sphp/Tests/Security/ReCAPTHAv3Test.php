<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Security;

use PHPUnit\Framework\TestCase;
use Sphp\Security\ReCAPTCHAv3;
use Sphp\Security\Exception\ReCAPTCHAException;
/**
 * Implementation of ReCAPTHAv3Test
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ReCAPTHAv3Test extends TestCase {

  public function testConstructor(): void {
    $reCaptcha = new ReCAPTCHAv3('foo', 'bar');
    $this->assertEquals('foo', $reCaptcha->getClienId());
    $this->assertEquals('bar', $reCaptcha->getSecret());
  }

  public function testScoreFailures(): void {
    $reCaptcha = new ReCAPTCHAv3('foo', 'bar');
    $this->expectException(ReCAPTCHAException::class);
    $reCaptcha->getScoreForResponse('foobar');
  }

}
