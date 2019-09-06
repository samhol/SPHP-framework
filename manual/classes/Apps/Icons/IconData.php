<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons;

/**
 * Implementation of IconData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IconData {

  /**
   * @var string
   */
  private $name;

  /**
   * @var string
   */
  private $label;

  /**
   * Constructor
   * 
   * @param string $name
   * @param string $label
   */
  public function __construct(string $name, string $label = null) {
    $this->name = $name;
    $this->label = $label;
  }

  public function getName(): string {
    return $this->name;
  }

  public function getLabel(): ?string {
    return $this->label;
  }

}
