<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons;

use Countable;

/**
 * Implementation of IconInformation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface IconGroup extends Countable {

  /**
   * 
   * @return string
   */
  public function getIconSetName(): string;

  /**
   * 
   * @return string
   */
  public function getGroupName(): string;

  /**
   * 
   * @return string
   */
  public function getLabel(): string;

  /**
   * 
   * @return string[]
   */
  public function getIconNames(): array;

  /**
   * 
   * @return IconData[]
   */
  public function getIcons(): array;

  /**
   * 
   * @return string[]
   */
  public function getSearchTerms(): array;
}
