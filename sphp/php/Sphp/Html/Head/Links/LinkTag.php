<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head\Links;

use Sphp\Html\EmptyTag;

/**
 * Implementation of an HTML link tag
 *
 *  The &lt;link&gt; tag defines the relationship between a document and an
 *  external resource. The &lt;link&gt; tag is most used to link to style
 *  sheets.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_link.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class LinkTag extends EmptyTag {

  /**
   * Constructor
   *
   * @param  string[] $attrs an array of attribute name value pairs
   */
  public function __construct(array $attrs = []) {
    parent::__construct('link');
    foreach ($attrs as $name => $value) {
      $this->attributes()->protect($name, $value);
    }
  }

  public function getHref(): string {
    return $this->getAttribute('href');
  }

  public function getRel(): string {
    return $this->getAttribute('rel');
  }

}
