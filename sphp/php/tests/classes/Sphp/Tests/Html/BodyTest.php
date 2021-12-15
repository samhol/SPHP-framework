<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Body;
use Sphp\Html\Scripts\ScriptsContainer;
use Sphp\Html\Div;
use Sphp\Html\Scripts\InlineScript;

/**
 * Description of BodyTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BodyTest extends TestCase {

  public function validBodyContent(): array {
    $data = [];
    $data[] = [''];
    $data[] = ['foo'];
    return $data;
  }

  /**
   * @dataProvider validBodyContent
   * @param mixed $content
   */
  public function testConstructor($content) {
    $body = new Body($content);
    $this->assertSame('', (string) $body->scripts());
    $this->assertSame("<body>" . $content . $body->scripts() . "</body>", (string) $body);
    $code = new InlineScript('foo=0;');

    $body->scripts()->insert($code);
    $this->assertSame((string) $code, (string) $body->scripts());
    $this->assertSame("<body>" . $content . $body->scripts() . "</body>", (string) $body);
  }

  public function testScripts() {
    $body = new Body();
    $scripts = new ScriptsContainer();
    $scripts->insertExternal('/foo.js');
    $this->assertSame($scripts, $body->scripts($scripts));
    $this->assertSame("<body>" . $body->scripts() . "</body>", (string) $body);
  }

  public function testClose(): Body {
    $body = new Body();
    $content = new Div('foos');
    $body->append($content);
    $body->scripts()->insertExternal('/foo.js');
    $this->assertSame($body->scripts() . "</body>", (string) $body->close());
    return $body;
  }

  /**
   * @depends testClose
   * 
   * @param  Body $body
   * @return Body
   */
  public function testClone(Body $body): Body {
    $cloned = clone $body;
    $this->assertNotSame($body->getContent(), $cloned->getContent());
    $this->assertNotSame($body->scripts(), $cloned->scripts());
    $this->assertSame((string) $body, (string) $cloned);
    return $body;
  }

}
