<?php

declare(strict_types=1);

namespace Sphp\Tests\Network;

use PHPUnit\Framework\TestCase;
use Sphp\Network\RemoteResource;

class RemoteResourceTest extends TestCase {

  public function remoteMimes(): iterable {
    yield ['irc://irc.example.com/channel', null];
  }

  /**
   * @dataProvider remoteMimes
   *
   * @param string $url
   * @param string $expected
   */
  public function testGetMimeType(string $url, string $expected = null): void {
    $this->assertSame($expected, RemoteResource::getMimeType($url));
  }

  public function remoteFilePaths(): iterable {
    yield ['https://www.google.fi/', true];
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
