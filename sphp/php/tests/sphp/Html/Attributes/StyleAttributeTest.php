<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Attributes;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\StyleAttribute;

/**
 * Class StyleAttributeTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class StyleAttributeTest extends TestCase {

  public function testConstructor(): void {
    $attr = new StyleAttribute;
    $this->assertSame('', (string) $attr);
    $attr->forceVisibility();
    $this->assertSame('style', (string) $attr);
    $attr->setProperty('a', 'b');
    $this->assertSame('style="a:b;"', (string) $attr);
  }

}
