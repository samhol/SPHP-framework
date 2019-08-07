<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Apps\HyperlinkGenerators\Sami\SamiUrlGenerator;

/**
 * Description of AbstractClassLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractClassLinkerTest extends TestCase {

  public function testConstructor() {
    $samiLinks = new SamiUrlGenerator('/foo');
    $linker = $this->getMockForAbstractClass(AbstractClassLinker::class, [\DateTime::class, $samiLinks]);
    $this->assertSame($linker, $linker);
  }

}
