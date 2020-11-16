<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Navigation;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Navigation\Nav;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Navigation\A;
use Sphp\Html\Navigation\HyperlinkContainer;

/**
 * Class NavTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class NavTest extends TestCase {

  public function testHyperlinks(): void {
    $nav = new Nav();
    $nav->append($a[] = new A('foo', 'bar'));
    $nav->append('foo');
    $nav->append($a[] = (new HyperlinkContainer('foo'))->setHref('/foobar'));
    $this->assertCount(3, $nav);
    $a[] = $nav->appendHyperlink('boz', 'zap', '_blank');
    $this->assertCount(4, $nav);
    $this->assertCount(3, $hyperlinks = $nav->getHyperlinks());
    $this->assertContainsOnly(Hyperlink::class, $hyperlinks);
  }

}
