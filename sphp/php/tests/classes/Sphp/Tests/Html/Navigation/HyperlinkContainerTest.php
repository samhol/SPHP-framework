<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Navigation;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Navigation\A;
use Sphp\Html\Navigation\HyperlinkContainer;

/**
 * Description of HyperlinkContainerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HyperlinkContainerTest extends TestCase {

  public function testEmptyHyperlink(): HyperlinkContainer {
    $component = new HyperlinkContainer('li');
    $this->assertSame('li', $component->getTagName());
    $this->assertInstanceOf(A::class, $component->getHyperlink());
    return $component;
  }

}
