<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms\Inputs;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\Inputs\HiddenInputs;
use Sphp\Html\Forms\Inputs\HiddenInput;

class HiddenInputsTest extends TestCase {

  public function arrayData(): array {
    $arr['foo'] = 'bar';
    return $arr;
  }

  public function createCollection(): \ArrayAccess {
    return new HiddenInputs();
  }

  public function testConstructor(): HiddenInputs {
    $inputs = new HiddenInputs();
    $this->assertCount(0, $inputs);
    $this->assertCount(0, $inputs->getByName('foo'));
    $this->assertSame('', "$inputs");
    $this->assertSame([], $inputs->toArray());
    $this->assertFalse($inputs->contains('int'));
    return $inputs;
  }

  /**
   * @depends testConstructor
   * @param  HiddenInputs $inputs
   * @return HiddenInputs
   */
  public function testInsertAndFetching(HiddenInputs $inputs): HiddenInputs {
    $this->assertFalse($inputs->contains('int'));
    $input = $inputs->insertVariable('int', 1);
    $this->assertTrue($inputs->contains('int'));
    $this->assertCount(1, $inputs);
    $this->assertSame('int', $input->getName());
    $this->assertSame(1, $input->getSubmitValue());
    $this->assertTrue($inputs->getByName('int')->contains('int'));
    return $inputs;
  }

  /**
   * @depends testInsertAndFetching
   * 
   * @param  HiddenInputs $inputs
   * @return HiddenInputs
   */
  public function testInsertArray(HiddenInputs $inputs): HiddenInputs {
    $input[] = $inputs->insertVariable('arr[]', 1);
    $this->assertTrue($inputs->contains('arr[]'));
    $input[] = $inputs->insertVariable('arr[]', 3.1415);
    $input[] = $inputs->insertVariable('arr[]', 'some text');
    $this->assertTrue($inputs->contains('arr[]'));
    $this->assertCount(3, $arrInputs = $inputs->getByName('arr[]'));
    $this->assertSame($input, $arrInputs->toArray());
    return $inputs;
  }

  /**
   * @depends testInsertArray
   * @param  HiddenInputs $inputs
   * @return HiddenInputs
   */
  public function testGetByName(HiddenInputs $inputs): HiddenInputs {
    $this->assertFalse($inputs->contains('float'));
    $input = $inputs->insertVariable('float', 1);
    $this->assertSame(1, $input->getSubmitValue());
    $this->assertSame('float', $input->getName());
    $this->assertCount(1, $inputs->getByName('float'));
    $this->assertCount(0, $foos = $inputs->getByName('foo'));
    return $inputs;
  }

  /**
   * @depends testInsertAndFetching
   * 
   * @param  HiddenInputs $inputs
   * @return HiddenInputs
   */
  public function testIteratorAndToArray(HiddenInputs $inputs): HiddenInputs {
    $this->assertContainsOnly(HiddenInput::class, $inputs);
    $arr1 = $inputs->toArray();
    $arr2 = iterator_to_array($inputs);
    $this->assertContainsOnly(HiddenInput::class, $arr1);
    $this->assertSame($arr1, $arr2);
    return $inputs;
  }

  /**
   * @depends testIteratorAndToArray
   * 
   * @param  HiddenInputs $inputs
   * @return HiddenInputs
   */
  public function testDisabling(HiddenInputs $inputs): HiddenInputs {
    $this->assertSame($inputs, $inputs->disable(true));
    $this->assertFalse($inputs->isEnabled());
    foreach ($inputs as $input) {
      $this->assertFalse($input->isEnabled());
    }
    $this->assertSame($inputs, $inputs->disable(false));
    $this->assertTrue($inputs->isEnabled());
    foreach ($inputs as $input) {
      $this->assertTrue($input->isEnabled());
    }
    $inputs->insertVariable('xyz', 'abc')->disable(true);
    $this->assertTrue($inputs->isEnabled());
    return $inputs;
  }

  /**
   * @depends testDisabling
   * 
   * @param  HiddenInputs $inputs
   * @return void
   */
  public function testClone(HiddenInputs $inputs): void {
    $clones = clone $inputs;
    $cloneArray = $clones->toArray();
    foreach ($inputs->toArray() as $no => $input) {
      $this->assertNotSame($cloneArray[$no], $input);
      $this->assertEquals($cloneArray[$no], $input);
    }
  }

}
