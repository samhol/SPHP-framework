<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\IdStorage;

class IdStorageTest extends TestCase {

  /**
   * @return IdStorage
   */
  public function testConstructor(): IdStorage {
    $storage = new IdStorage();
    $this->assertFalse($storage->contains('a'));
    $this->assertCount(0, $storage);
    return $storage;
  }

  /**
   * @depends testConstructor
   * 
   * @param  IdStorage $storage
   * @return IdStorage
   */
  public function testStoring(IdStorage $storage): IdStorage {
    $this->assertFalse($storage->contains('a'));
    $this->assertTrue($storage->store('a'));
    $this->assertTrue($storage->contains('a'));
    $this->assertFalse($storage->store('a'));
    $this->assertTrue($storage->store('b'));
    $this->assertTrue($storage->contains('b'));
    return $storage;
  }

  /**
   * @depends testStoring
   * 
   * @param  IdStorage $storage
   * @return IdStorage
   */
  public function testReplace(IdStorage $storage): void {
    $this->assertTrue($storage->replace('a', 'c'));
    $this->assertFalse($storage->contains('a'));
    $this->assertTrue($storage->contains('b'));
    $this->assertTrue($storage->contains('c'));
    $this->assertTrue($storage->replace('d', 'a'));
    $this->assertFalse($storage->contains('d'));
    $this->assertTrue($storage->contains('a'));
    $this->assertTrue($storage->contains('b'));
    $this->assertTrue($storage->contains('c'));
  }

  /**
   * @covers \Sphp\Html\Attributes\IdStorage::generateRandom
   * @return void
   */
  public function testGenerateRandom(): void {
    $storage = IdStorage::get('random-attr');
    for ($i = 0; $i < 50; $i++) {
      $value = $storage->generateRandom(2);
      $this->assertTrue($storage->contains($value));
    }
  }

}
