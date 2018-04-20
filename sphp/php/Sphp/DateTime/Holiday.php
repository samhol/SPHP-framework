<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;


/**
 * Description of Holiday
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Holiday extends SpecialDay {

  /**
   * 
   * 
   * @param Date $date
   * @param string $name
   */
  public function __construct(Date $date, string $name) {
    parent::__construct($date, $name);
  }

}
