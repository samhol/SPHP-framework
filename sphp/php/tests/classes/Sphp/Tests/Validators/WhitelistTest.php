<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Validators;

use Sphp\Validators\Whitelist;
use Sphp\Validators\Validator;

class WhitelistTest extends ValidatorTestCase {

  public function testConstructor(): void {
    $validator = $this->createValidator();
    $this->assertCount(0, $validator->getMessages());
    $this->assertEquals(['a', 'b', 0], $validator->getWhitelist());
  }

  /**
   */
  public function testChangeWhitelist(): void {
    $validator = $this->createValidator();
    $validator->setWhitelist([1, 2]);
    $this->assertEquals([1, 2], $validator->getWhitelist());
  }

  public function testInvalidValue(): void {
    $validator = $this->createValidator();
    $this->assertFalse($validator->isValid([1 => 'foo']));
    $this->assertCount(1, $validator->getMessages());
    $this->assertContains('An illegal key found', $validator->getMessages());
  }

  /**
   */
  public function testInvalidValueType(): void {
    $validator = $this->createValidator();
    $this->assertFalse($validator->isValid('a'));
    $this->assertCount(1, $validator->getMessages());
    $this->assertContains('Array expected', $validator->getMessages());
  }

  /**
   */
  public function testNotArray(): void {
    $validator = $this->createValidator();
    $this->assertFalse($validator->isValid(1));
    $this->assertContains('Array expected', $validator->getMessages());
  }

  public function createValidator(): Whitelist {
    return new Whitelist(['a', 'b', 0], 'An illegal key found');
  }

  public function invalidValuesProvider(): iterable {
    yield [range(1, 3)];
    yield ['a'];
  }

  public function validValuesProvider(): iterable {
    yield [['a' => 1, 'b' => 2]];
    yield [['a' => null, 'b' => 2]];
  }

}
