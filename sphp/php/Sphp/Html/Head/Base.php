<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\EmptyTag;

/**
 * Implementation of an HTML base tag
 *
 *  The &lt;base&gt; tag specifies the base URL/target for all relative URLs in 
 *  a document. There can be at maximum one &lt;base&gt; element in a document, 
 *  and it must be inside the &lt;head&gt; element.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_base.asp w3schools HTML API
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Base extends EmptyTag implements MetaData {

  /**
   * Constructor
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string $target specifies the default target for all hyperlinks and forms in the page
   * @link   https://www.w3schools.com/tags/att_base_href.asp href attribute
   * @link   https://www.w3schools.com/tags/att_base_target.asp target attribute
   */
  public function __construct(string $href = null, string $target = null) {
    parent::__construct('base');
    if ($href !== null) {
      $this->setHref($href);
    }
    if ($target !== null) {
      $this->setTarget($target);
    }
  }

  /**
   * Sets the href attribute (The URL of the link).
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_base_href.asp href attribute
   */
  public function setHref(string $href) {
    return $this->setAttribute('href', $href);
  }

  /**
   * Sets the target attribute.
   *
   * **Notes:**
   *  
   * 1. The target attribute specifies the default target for all hyperlinks and forms in the page.
   * 2. This attribute can be overridden by using the target attribute for each hyperlink/form.
   *
   * @param  string $target target attribute's value
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_base_target.asp target attribute
   */
  public function setTarget(string $target) {
    return $this->setAttribute('target', $target);
  }

  public function getHash(): string {
    return 'base';
  }

  public function toArray(): array {
    $out = [];
    $out ['href'] = $this->getAttribute('href');
    if ($this->attributeExists('target')) {
      $out ['target'] = $this->getAttribute('target');
    }
    return $out;
  }

}
