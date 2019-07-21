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

  public function headerData(): array {

    return [
        ['foo', 'bar'],
        //['foo', null],
        ['foo', true],
        ['foo', time()],
    ];
  }

  protected function validateString(Header $cookie, string $cookieStr) {
    /// echo "$cookieStr\n";
    $name = $cookie->getName();
    $value = $cookie->getValue();
    $this->assertSame($cookie->getName() . ": " . $cookie->getValue(), $cookieStr);
  }

  /**
   * @runInSeparateProcess
   */
  public function testSave() {
    $header = new GenericHeader('foo', 'bar');
    $this->assertTrue($header->save());
    $headers1 = xdebug_get_headers();
    $this->assertArrayHasKey(0, $headers1, 'Headers not send');
    $this->validateString($header, $headers1[0]);
    $header->setValue('bite');
    $this->assertTrue($header->reset());
    $headers2 = xdebug_get_headers();
    $this->assertArrayHasKey(0, $headers2, 'Headers not send');
    $this->validateString($header, $headers2[0]);
    $this->assertTrue($header->delete());
    $headers3 = xdebug_get_headers();
    $this->assertTrue(headers_sent(), 'qtrqaerera');
    //$this->assertArrayNotHasKey(0, $headers3, 'Headers not send');
    print_r($headers1);
    print_r($headers2);
    print_r($headers3);
    $this->assertfalse($header->save());
    $this->assertfalse($header->delete());
    $this->assertfalse($header->reset());
  }

}
