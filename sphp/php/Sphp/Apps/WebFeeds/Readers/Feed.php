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

use Traversable;
use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Interface FeedInterface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface Feed extends Traversable, Countable, Arrayable {

  /**
   * Returns the title
   * 
   * @return string the title
   */
  public function getTitle(): string;

  /**
   * Returns the links
   * 
   * @return Link[] the links
   */
  public function getLinks(): array;

  /**
   * Returns the permanent home link
   * 
   * @return Link|null the permanent home link
   */
  public function getSelfLink(): ?Link;

  /**
   * Returns the links
   * 
   *  @return Link|null the link
   */
  public function getAlternativeLink(): ?Link;

  /**
   * Returns the links with specific rel attributes
   * 
   * @param  string|null $rel
   * @return Link[] the links
   */
  public function getLinksByRel(?string ...$rel): array;
}
