<?php

namespace Sphp\Network;

class RemoteResourceTest extends \PHPUnit\Framework\TestCase {

  /**
   * @return array
   */
  public function remoteMimes(): array {
    $url[] = ['irc://irc.example.com/channel', ''];
    $url[] = ['http://www.example.com', 'text/html; charset=UTF-8'];
    return $url;
  }

  /**
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
        ['http://www.google.fi/', true],
    ];
  }

  /**
   * @dataProvider remoteFilePaths
   *
   * @param string $url
   * @param bool $exists
   */
  public function testExists(string $url, bool $exists) {
    $this->assertSame($exists, RemoteResource::exists($url));
  }

}
