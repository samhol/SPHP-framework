<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Head\Links;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Head\Links\ImmutableLinkData;
use Sphp\Html\Head\Links\LinkTag;
use Sphp\Html\Head\Exceptions\MetaDataException;

class LinksTest extends TestCase {

  public function testConstructors(): void {
    $meta = new ImmutableLinkData(['rel' => 'icon', 'href' => 'icon.ico']);
    $tag = new LinkTag($meta->toArray());
    $this->assertEquals($tag->attributes()->toArray(), $meta->toArray());
    $this->assertEquals($tag, $meta->toTag());
  }

  public function invalidLinkData(): array {
    $data = [];
    $data[] = [[]];
    $data[] = [['rel' => 'a']];
    $data[] = [['href' => 'a']];
    $data[] = [['foo' => 'a']];
    return $data;
  }

  /**
   * @dataProvider invalidLinkData
   * 
   * @param string[] $data
   * @return void
   */
  public function testInvalidConstructorCalls(array $data): void {
    $this->expectException(MetaDataException::class);
    new ImmutableLinkData($data);
  }

  public function overlappingMetaData(): array {
    $data = [];
    $data[] = [
        ['href' => 'a', 'rel' => 'b'],
        ['href' => 'a', 'rel' => 'b'],
        true];
    $data[] = [
        ['href' => 'a', 'rel' => 'b', 'title' => 'c'],
        ['href' => 'a', 'rel' => 'b', 'title' => 'c'],
        true];
    $data[] = [
        ['href' => 'a', 'rel' => 'b'],
        ['href' => 'a', 'rel' => 'c'],
        false];
    return $data;
  }

  /**
   * @dataProvider overlappingMetaData
   * 
   * @param  array $set1
   * @param  array $set2
   * @param  bool $isOverlapping
   * @return void
   */
  public function testOverLapping(array $set1, array $set2, bool $isOverlapping): void {
    $link1 = new ImmutableLinkData($set1);
    $link2 = new ImmutableLinkData($set2);
    if ($isOverlapping) {
      $this->assertSame($link1->getHash(), $link2->getHash());
    } else {
      $this->assertNotSame($link1->getHash(), $link2->getHash());
    }
  }

  public function testOutput(): void {
    $link1 = new ImmutableLinkData(['rel' => 'icon', 'href' => 'icon.ico']);
    $link2 = new ImmutableLinkData(['rel' => 'icon', 'href' => 'icon.ico']);
    $this->assertSame((string) $link1->toTag(), (string) $link2);
  }

  public function validInputData(): array {
    $data = [];
    $data[] = ['icon', 'icon.ico'];
    $data[] = ['style', 'style.css'];
    return $data;
  }

  /**
   * @dataProvider validInputData
   * @param string $rel
   * @param string $href
   * @return void
   */
  public function testGetters(string $rel, string $href): void {
    $link = new ImmutableLinkData(['rel' => $rel, 'href' => $href]);
    $linkTag = $link->toTag();
    $this->assertSame($rel, $link->getRel());
    $this->assertSame($href, $link->getHref());
    $this->assertSame($rel, $linkTag->getRel());
    $this->assertSame($href, $linkTag->getHref());
    $this->assertSame($link->toTag()->getHtml(), $link->getHtml());
  }

}
