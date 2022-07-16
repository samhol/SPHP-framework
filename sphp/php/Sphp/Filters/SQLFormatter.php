<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

use Doctrine\SqlFormatter\NullHighlighter;
use Doctrine\SqlFormatter\SqlFormatter as DoctrineFormatter;

/**
 * Filter formats an SQL string
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SQLFormatter extends AbstractFilter {

  public function filter(mixed $variable):mixed {
    if (is_string($variable)) {
      return (new DoctrineFormatter(new NullHighlighter()))->format($variable);
    }
    return $variable;
  }

}
