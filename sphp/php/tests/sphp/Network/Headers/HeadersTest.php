<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Headers;

use PHPUnit\Framework\TestCase;

/**
 * Header collection Tests
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class HeadersTest extends TestCase {

  /**
   * @return Headers
   */
  public function testConstructor(): Headers {
    $headers = new Headers();
    $this->assertCount(0, $headers);
    return $headers;
  }

  /**
   * @depends testConstructor
   * @param   Headers $headers
   * @return  Headers
   */
  public function testAppending(Headers $headers): Headers {
    $this->assertFalse($headers->containsHeader('Access-Control-Allow-Origin'));
    $header = $headers->appendAccessControlAllowOrigin('google.com');
    $this->assertInstanceOf(Header::class, $header);
    $this->assertSame('Access-Control-Allow-Origin', $header->getName());
    $this->assertSame('google.com', $header->getValue());
    $this->assertCount(1, $headers);
    $this->assertTrue($headers->containsHeader('Access-Control-Allow-Origin'));
    //$this->assertSame('foo-bar', $headers->getValue());
    return $headers;
  }

}
