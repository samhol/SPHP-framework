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

use tidy;

/**
 * Filter formats an `HTML` code string
 * 
 * **IMPORTANT!** manipulates only string inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 * @see     https://github.com/gajus/dindent
 */
class HTMLCodeFormatter extends AbstractFilter {

  private tidy $tidy;

  public function __construct() {
    $config = array(
        'indent' => true,
        'output-xhtml' => false,
        'show-body-only' => true);
    $this->tidy = new tidy(null, $config, 'utf8');
  }

  public function __destruct() {
    unset($this->tidy);
  }

  public function filter($variable) {
    $this->tidy->parseString($variable);
    return (string) $this->tidy;
  }

}
