<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\WebFeeds\Readers;

use Sphp\Apps\WebFeeds\Readers\RSS;
use Sphp\Apps\WebFeeds\Readers\RSSItem;
use PHPUnit\Framework\TestCase;
use Sphp\DateTime\ImmutableDateTime;
use Sphp\Apps\WebFeeds\Exceptions\RSSException;
use Sphp\Apps\WebFeeds\Readers\FeedLink;

/**
 * Implementation of W3schoolsTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class RSSTest extends TestCase {

  public function files(): array {
    $data = [];
    $data[] = ['./sphp/php/tests/files/rss.xml'];
    return $data;
  }

  /**
   * @dataProvider files
   *
   * @param  string $path
   * @return void
   */
  public function testChannelData(string $path): void {
    $xml = simplexml_load_file($path);
    $feed = new RSS($xml);
    $this->assertCount($feed->count(), $feed->toArray());
    $this->assertSame((string) $xml->channel->title, $feed->getTitle());
    $this->assertSame((string) $xml->channel->description, $feed->getDescription());
    $this->assertSame((string) $xml->channel->language, $feed->getLanguage());
    $this->assertSame((string) $xml->channel->category, $feed->getCategory());
    //$this->assertSame((string) $xml->channel->link, $feed->getLink());
    $dateString = (string) $xml->channel->lastBuildDate;
    $date = ImmutableDateTime::from($dateString);
    $this->assertEquals($date, $feed->getUpdated());

    $this->assertEquals($dateString, $feed->getUpdated()->format(\DateTimeInterface::RSS));
  }

  public function testEntries() {
    $xml = simplexml_load_file('./sphp/php/tests/files/rss.xml');
    $rss = new RSS($xml);
    $this->assertContainsOnlyInstancesOf(RSSItem::class, $rss);
  }

  public function testConstructorFailure(): void {
    $xml = simplexml_load_file('./sphp/php/tests/files/note.xml');
    $this->expectException(RSSException::class);
    new RSS($xml);
  }

  public function testLinks(): void {
    $xml = simplexml_load_file('./sphp/php/tests/files/rss.xml');
    $rss = new RSS($xml);
    $links = $rss->getLinks();
    $this->assertContainsOnlyInstancesOf(FeedLink::class, $links);
    $this->assertCount(2, $links);
    foreach ($links as $link) {
      $this->assertSame((string) $link, $link->getHref());
    }
    foreach ($xml->xpath('//link') as $linkData) {
      $link = new FeedLink($linkData);
      $this->assertSame((string) $linkData, $link->getHref());
      $this->assertSame((string) $linkData, (string) $link);
    }
  }

}
