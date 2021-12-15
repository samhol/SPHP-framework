<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\AbstractDocumentationLinker;
use Sphp\Documentation\Linkers\ApiDocURLBuilder;

/**
 * Class AbstractApiLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractApiLinkerTest extends TestCase {

  public function build(): AbstractDocumentationLinker {
    $urlGen = $this->getMockForAbstractClass(ApiDocURLBuilder::class, ['root', 'apiname']);
    $mock = $this->getMockForAbstractClass(AbstractDocumentationLinker::class, [$urlGen]);
    return $mock;
  }

  public function testConstructor() {
    $gen = $this->build();
    $this->assertSame('root', $gen->pointTo()->getHref());
    $this->assertSame('apiname', $gen->pointTo()->contentToString());
    $this->assertSame($gen->pointTo()->getHtml(), $gen->getHtml());
  }

}
