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
 * The AbstractEntry class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractEntry implements Entry {

  private SimpleXMLElement $xml;

  /**
   * @var Link[]
   */
  private array $links;

  /**
   * Constructor
   * 
   * @param SimpleXMLElement $rawItem
   */
  public function __construct(SimpleXMLElement $rawItem) {
    $this->xml = $rawItem;
    $this->links = $this->parseLinks();
  }

  /**
   * Parses all the links
   * 
   * @return Link[] the links
   */
  abstract protected function parseLinks(): array;

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->links, $this->xml);
  }

  public function getTitle(): string {
    return (string) $this->xml->title;
  }

  /**
   * 
   * @return FeedLink[]
   */
  public function getLinks(): array {
    return $this->links;
  }

  public function getAlternativeLink(): ?Link {
    $selfLinks = $this->getLinksByRel('alternate');
    if (empty($selfLinks)) {
      $selfLinks = $this->getLinksByRel(null);
    }
    if (!empty($selfLinks)) {
      $out = array_shift($selfLinks);
    } else {
      $out = null;
    }
    return $out;
  }

  public function getLinksByRel(?string ...$rel): array {
    return array_filter($this->getLinks(), function (Link $val) use ($rel) {
      return in_array($val->getRel(), $rel, true);
    });
  }

}
