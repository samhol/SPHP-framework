<?php

namespace Sphp\Stdlib\Networks;

class RemoteResourceTests extends \PHPUnit\Framework\TestCase {

  /**
   * @return array
   */
  public function remoteMimes(): array {
    $url[] = ['irc://irc.example.com/channel', ''];
    $url[] = ['http://www.example.com', 'text/html'];
    $url[] = ['http://playground.samiholck.com/manual/pics/sphp-code-logo.png', 'image/png'];
    return $url;
  }

  /**
   *
   * @covers RemoteResource::getMimeType
   * @dataProvider remoteMimes
   *
   * @param string $url
   * @param string $expected
   */
  public function testGetMimeType(string $url, string $expected) {
    $this->assertSame(RemoteResource::getMimeType($url), $expected);
  }

  /**
   * @return array
   */
  public function remoteFilePaths(): array {
    return [
        ['http://placehold.it/350x150/0f0/fff', true],
        ['http://www.samiholck.com/', true],
        ['http://www.google.fi/', true],
    ];
  }

  /**
   * @covers RemoteResource::exists
   * @dataProvider remoteFilePaths
   */
  public function testExists(string $url, bool $exists) {
    $this->assertSame($exists, RemoteResource::exists($url));
  }

}
