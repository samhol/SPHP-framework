<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\Html\W3schoolsURLs;

/**
 * Class W3schoolsURLsTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class W3schoolsURLsTest extends TestCase {

  public function testConstructor() {
    $gen = new W3schoolsURLs();
    $this->assertSame('https://www.w3schools.com/', $gen->getRootUrl());
  }

  public function tagMap(): array {
    $attrs = [];
    $attrs[] = ['a', 'https://www.w3schools.com/tags/tag_a.asp'];
    $attrs[] = ['b', 'https://www.w3schools.com/tags/tag_b.asp'];
    $attrs[] = ['h1', 'https://www.w3schools.com/tags/tag_hn.asp'];
    $attrs[] = ['h2', 'https://www.w3schools.com/tags/tag_hn.asp'];
    $attrs[] = ['h3', 'https://www.w3schools.com/tags/tag_hn.asp'];
    $attrs[] = ['h4', 'https://www.w3schools.com/tags/tag_hn.asp'];
    $attrs[] = ['h5', 'https://www.w3schools.com/tags/tag_hn.asp'];
    $attrs[] = ['h6', 'https://www.w3schools.com/tags/tag_hn.asp'];
    return $attrs;
  }

  /**
   * @dataProvider tagMap
   * 
   * @param  string $tag
   * @param  string $url
   * @return void
   */
  public function testCreateTagUrl(string $tag, string $url): void {
    $gen = new W3schoolsURLs();
    $this->assertSame($url, $gen->getTagUrl($tag));
  }

  public function attributeMap(): array {
    $attrs = [];
    $attrs[] = ['accept', 'https://www.w3schools.com/tags/att_accept.asp'];
    $attrs[] = ['alt', 'https://www.w3schools.com/tags/att_alt.asp'];
    $attrs[] = ['onmouseout', 'https://www.w3schools.com/tags/att_onmouseout.asp'];
    return $attrs;
  }

  public function getUrlData(): iterable {
    yield ['https://www.w3schools.com/tags/att_accept.asp', null, 'accept'];
    yield ['https://www.w3schools.com/tags/tag_a.asp', 'a', null];
    yield ['https://www.w3schools.com/tags/att_a_href.asp', 'a', 'href'];
    yield ['https://www.w3schools.com/', null, null];
  }

  /**
   * @dataProvider getUrlData
   *  
   * @param  string $expected
   * @param  string|null $tagName
   * @param  string|null $attrName
   * @return void
   */
  public function testGetURL(string $expected, ?string $tagName = null, ?string $attrName = null): void {
    $gen = new W3schoolsURLs();
    $this->assertSame($expected, $gen->getUrl($tagName, $attrName));
  }

  /**
   * @dataProvider attributeMap
   * 
   * @param  string $attr
   * @param  string $url
   * @return void
   */
  public function testCreateAttributeUrl(string $attr, string $url): void {
    $gen = new W3schoolsURLs();
    $this->assertSame($url, $gen->getGlobalAttrUrl($attr));
  }

  public function tagAttributeMap(): iterable {
    yield ['a', 'href', 'https://www.w3schools.com/tags/att_a_href.asp'];
    yield ['input', 'type', 'https://www.w3schools.com/tags/att_input_type.asp'];
  }

  /**
   * @dataProvider tagAttributeMap
   * 
   * @param  string $tag
   * @param  string $attr
   * @param  string $url
   * @return void
   */
  public function testCreateTagAttributeUrl(string $tag, string $attr, string $url): void {
    $gen = new W3schoolsURLs();
    $this->assertSame($url, $gen->getTagAttrUrl($tag, $attr));
  }

}
