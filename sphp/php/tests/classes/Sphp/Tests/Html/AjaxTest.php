<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Ajax;

class AjaxTest extends TestCase {

  public function testOutput(): void {
    $path = '/foo.php';
    $ajax = new Ajax();
    $this->expectOutputString((string) $ajax->createContentLoader($path));
    $ajax->load($path);
  }

}
