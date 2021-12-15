<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\WebFeeds\Readers;

use SimpleXMLElement;

/**
 * The AtomLink class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FeedLink implements Link {

  /**
   * @var SimpleXMLElement
   */
  private SimpleXMLElement $xml;

  /**
   * Constructor
   * 
   * @param  SimpleXMLElement $xml
   * @throws RSSException
   */
  public function __construct(SimpleXMLElement $xml) {
    $this->xml = $xml;
  }

  public function __destruct() {
    unset($this->xml);
  }

  public function getHref(): string {
    if ($this->xml->attributes()['href'] === null) {
      $href = (string) $this->xml;
    } else {
      $href = (string) $this->xml->attributes()['href'];
    }
    return $href;
  }

  public function getRel(): ?string {
    $rel = $this->xml->attributes()['rel'];
    if ($rel !== null) {
      $rel = (string) $rel;
    }
    return $rel;
  }

  public function getType(): ?string {
    $rel = $this->xml->attributes()['type'];
    if ($rel !== null) {
      $rel = (string) $rel;
    }
    return $rel;
  }

  public function __toString(): string {
    return $this->getHref();
  }

}
