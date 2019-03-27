<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core\DataOptions;

/**
 * Description of IndividualDataAttributesTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
trait DataOpitonTrait {

  abstract public function attributes(): \Sphp\Html\Attributes\HtmlAttributeManager;

  /**
   * Sets a menu option used in a Foundation menu
   * 
   * @param  string $name the name of the option
   * @param  scalar $value the value of the option
   * @return $this for a fluent interface
   */
  public function setOption(string $name, $value) {
    if (is_bool($value)) {
      $value = $value ? 'true' : 'false';
    }
    $this->options->setProperty($name, $value);
    return $this;
  }
}
