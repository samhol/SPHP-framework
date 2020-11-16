<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Flow\Headings;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Flow\Headings\AbstractHeading;

/**
 * Class AbstractHeadingTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractHeadingTest extends TestCase {

  public function createHeading(string $tagName): AbstractHeading {
    return $this->getMockForAbstractClass(AbstractHeading::class, [$tagName]);
  }

  public function testGetLevel(): void {
    for ($level = 1; $level < 7; ++$level) {
      $tagName = "h$level";
      $heading = $this->createHeading($tagName);
      $this->assertSame($level, $heading->getLevel());
      $this->assertSame($tagName, $heading->getTagName());
    }
  }

}
