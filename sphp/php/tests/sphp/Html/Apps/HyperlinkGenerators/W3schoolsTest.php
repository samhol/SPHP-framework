<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use PHPUnit\Framework\TestCase;

/**
 * Implementation of W3schoolsTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class W3schoolsTest extends TestCase {

  public function tags(): array {
    $data = [];
    $data[] = ['a', '&lt;aa&gt;', 'https://www.w3schools.com/tags/tag_a.asp'];
    $data[] = ['h1', '&lt;aa&gt;', 'https://www.w3schools.com/tags/tag_hn.asp'];
    $data[] = ['h2', '&lt;aa&gt;', 'https://www.w3schools.com/tags/tag_hn.asp'];
    $data[] = ['h3', '&lt;aa&gt;', 'https://www.w3schools.com/tags/tag_hn.asp'];
    $data[] = ['h4', '&lt;aa&gt;', 'https://www.w3schools.com/tags/tag_hn.asp'];
    $data[] = ['h5', '&lt;aa&gt;', 'https://www.w3schools.com/tags/tag_hn.asp'];
    $data[] = ['h6', '&lt;aa&gt;', 'https://www.w3schools.com/tags/tag_hn.asp'];
    return $data;
  }

  /**
   * @dataProvider tags
   * @return void
   */
  public function testTag(string $tag, string $text, string $url): void {
    $linker = new W3schools();
    $link = $linker->tag($tag);
    $this->assertEquals($link, $linker($tag));
    $this->assertEquals($link, $linker->$tag);
    $this->assertEquals($url, $link->getHref());
  }

  public function attrs(): array {
    $data = [];
    $data[] = ['title', '&lt;aa&gt;', 'https://www.w3schools.com/tags/att_title.asp'];
    return $data;
  }

  /**
   * @dataProvider attrs
   * @return void
   */
  public function testAttr(string $tag, string $text, string $url): void {
    $linker = new W3schools();
    $link = $linker->attr($tag);
    $this->assertEquals($url, $link->getHref());
  }

}
