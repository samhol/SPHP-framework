<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\WebFeeds\Readers;

use PHPUnit\Framework\TestCase;
use SimpleXMLElement;
use Sphp\Apps\WebFeeds\Readers\FeedLink;
use Sphp\Apps\WebFeeds\Exceptions\AtomException;

/**
 * The AtomLinkTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FeedLinkTest extends TestCase {

  public function files(): array {
    $data = [];
    $data[] = [simplexml_load_file('./sphp/php/tests/files/atom.xml')];
    $data[] = [simplexml_load_file('./sphp/php/tests/files/rss.xml')];
    return $data;
  }

  /**
   * @dataProvider files
   *
   * @param  SimpleXMLElement $xml
   * @return void
   */
  public function testAttributeEntries(SimpleXMLElement $xml): void {
    $xml->registerXPathNamespace('atom', 'http://www.w3.org/2005/Atom');
    $hrefTags = $xml->xpath('//atom:link[@href] | //link[@href]');
    foreach ($hrefTags as $linkTag) {
      //var_dump($data->attributes()['href']);
      $obj = new FeedLink($linkTag);
      $this->assertSame((string) $linkTag->attributes()['href'], $obj->getHref());

      $this->assertSame((string) $linkTag->attributes()['href'], (string) $obj);
    }
  }

  /**
   * @dataProvider files
   *
   * @param  SimpleXMLElement $xml
   * @return void
   */
  public function testTagAttributes(SimpleXMLElement $xml): void {
    $xml->registerXPathNamespace('atom', 'http://www.w3.org/2005/Atom');
    foreach ($xml->xpath('//atom:link | //link') as $linkTag) {
      $obj = new FeedLink($linkTag);
      foreach ($linkTag->attributes() as $name => $valueObj) {
        $value = (string) $valueObj;
        if ($name === 'rel') {
          $this->assertSame($value, $obj->getRel());
        }
        if ($name === 'href') {
          $this->assertSame($value, $obj->getHref());
        }
        if ($name === 'type') {
          $this->assertSame($value, $obj->getType());
        }
      }
    }
  }

  public function invalidFeeds(): array {
    $data = [];
    $data[] = [simplexml_load_file('./sphp/php/tests/files/rss-link.xml')];
    return $data;
  }

  /**
   * @dataProvider invalidFeeds
   *
   * @param  SimpleXMLElement $xml
   * @return void
   */
  public function t1estFailure(SimpleXMLElement $xml) {
    $this->expectException(AtomException::class);
    print_r($xml->channel->link);
    new FeedLink($xml->channel->link[0]);
  }

}
