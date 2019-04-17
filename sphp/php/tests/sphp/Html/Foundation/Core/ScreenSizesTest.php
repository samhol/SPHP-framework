<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Exceptions\OutOfRangeException;

class ScreenSizesTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var Container
   */
  protected $screenSizes;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->screenSizes = new ScreenSizes();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->screenSizes);
  }

  public function testGetPreviousSize() {
    $this->assertSame($this->screenSizes->getPreviousSize('medium'), 'small');
    $this->assertSame($this->screenSizes->getPreviousSize('large'), 'medium');
    $this->assertSame($this->screenSizes->getPreviousSize('xlarge'), 'large');
    $this->assertSame($this->screenSizes->getPreviousSize('xxlarge'), 'xlarge');
    $this->expectException(OutOfRangeException::class);
    $this->screenSizes->getPreviousSize('small');
  }

  public function testGetNextSize() {
    $this->assertSame($this->screenSizes->getNextSize('small'), 'medium');
    $this->assertSame($this->screenSizes->getNextSize('medium'), 'large');
    $this->assertSame($this->screenSizes->getNextSize('large'), 'xlarge');
    $this->assertSame($this->screenSizes->getNextSize('xlarge'), 'xxlarge');
    $this->expectException(OutOfRangeException::class);
    $this->screenSizes->getNextSize('xxlarge');
  }

  /**
   * @return string[]
   */
  public function sizeExistsData() {
    return [
        [['foo', 'bar']],
        [['', '']],
        [['small', 'medium', 'large', 'xlarge', 'xxlarge']],
    ];
  }

  /**
   * @param string $data
   * @param boolean $result
   * @dataProvider sizeExistsData
   */
  public function testSizeExists($data) {
    $sizes = new ScreenSizes($data);
    foreach ($data as $size) {
      $this->assertTrue($sizes->sizeExists($size));
    }
  }

}
