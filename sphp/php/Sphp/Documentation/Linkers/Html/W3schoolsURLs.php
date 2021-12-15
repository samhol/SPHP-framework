<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\Html;

use Sphp\Documentation\Linkers\ApiDocURLBuilder;
use Sphp\Documentation\Linkers\Html\HtmlUrlGenerator;
use Sphp\Stdlib\Strings;

/**
 * URL generator pointing to online w3schools documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class W3schoolsURLs extends ApiDocURLBuilder implements HtmlUrlGenerator {

  /**
   * Constructor
   *
   * @param string $root
   * @param string $name
   */
  public function __construct(string $root = 'https://www.w3schools.com/', string $name = 'w3schools.com') {
    parent::__construct($root, $name);
  }

  public function getUrl(?string $tagName = null, ?string $attrName = null): string {
    $out = null;
    if ($tagName === null && $attrName === null) {
      $out = $this->getRootUrl();
    } else if ($tagName === null) {
      $out = $this->getGlobalAttrUrl($attrName);
    } else if ($attrName === null) {
      $out = $this->getTagUrl($tagName);
    } else {
      $out = $this->getTagAttrUrl($tagName, $attrName);
    }
    return $out;
  }

  public function getTagUrl(string $tagname): string {
    if (Strings::match($tagname, '/^([h][1-6])$/')) {
      $link = 'tags/tag_hn.asp';
    } else {
      $link = "tags/tag_$tagname.asp";
    }
    return $this->createUrl($link);
  }

  public function getTagAttrUrl(string $tagName, string $attrName): string {
    return $this->createUrl("tags/att_{$tagName}_{$attrName}.asp");
  }

  public function getGlobalAttrUrl(string $attrName): string {
    return $this->createUrl("tags/att_{$attrName}.asp");
  }

}
