<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Media\Icons;

/**
 * The Devicon class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Devicon extends IconObject {

  /**
   * Sets/unsets the alternative color for the icon 
   * 
   * @param  bool $colored
   * @return $this for a fluent interface
   */
  public function setColored(bool $colored) {
    if ($colored) {
      $this->icon->addCssClass('colored');
    } else {
      $this->icon->removeCssClass('colored');
    }
    return $this;
  }

}
