<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

/**
 * Definiton of a filter for HTML tables
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface TableFilter {

  /**
   * Applies the filter to the given table
   * 
   * @param  Table $table
   * @return void
   */
  public function useInTable(Table $table): void;

  /**
   * Invokes the filter to the given table
   * 
   * @param  Table $table
   * @return void
   */
  public function __invoke(Table $table): void;
}
