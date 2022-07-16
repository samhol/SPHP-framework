<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use PHPUnit\Framework\TestCase;
use Sphp\Validators\Regex;

/**
 * Implementation of RegexTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class RegexTest extends TestCase {

  public function testWithSkip(): void {
    $regex = new Regex('/foo/', $message = 'Not a foo');
    $this->assertTrue($regex->isValid('foop'));
    $this->assertCount(0, $regex->getMessages());
    $this->assertFalse($regex->isValid('fo op'));
    $this->assertCount(1, $regex->getMessages());
    $this->assertContains($message, $regex->getMessages());
    $this->assertSame($regex, $regex->skip(null));
    $this->assertTrue($regex->isValid(null));
    $this->assertFalse($regex->isValid('fo op'));
  }

  public function testInvalidTypes(): void {
    $regex = new Regex('/foo/', 'Foo is bar');
    $this->assertFalse($regex->isValid($invalid = new \stdClass()));
    $this->assertCount(1, $regex->getMessages());
    $this->assertEquals(
            $regex->getMessages()->buildMessageFromTemplate(Regex::INVALID, [':type' => gettype($invalid)]),
            $regex->getMessages()->getFirstMessage());
    $this->assertSame($regex, $regex->skip($invalid));
    $this->assertTrue($regex->isValid($invalid));
  }

}
