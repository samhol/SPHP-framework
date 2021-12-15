<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\WebFeeds\Readers;

/**
 * The Entry Interface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface Entry {

  /**
   * Returns the title of the feed entry
   * 
   * @return string the title of the feed entry
   */
  public function getTitle(): string;

  /**
   * Returns the link of the feed entry
   * 
   * @return Link|null the link of the feed entry
   */
  public function getAlternativeLink(): ?Link;

  /**
   * Returns the id of the feed entry
   * 
   * @return string the id of the feed entry
   */
  public function getId(): string;
}
