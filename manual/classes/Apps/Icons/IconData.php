<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons;

use Sphp\Html\Media\Icons\IconFactory;
use Sphp\Html\Media\Icons\Icon;

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
   * @var string
   */
  private $factoryName;

  /**
   * Constructor
   * 
   * @param string $name
   * @param string $label
   * @param string $factoryName
   */
  public function __construct(string $name, string $label = null, string $factoryName = IconFactory::class) {
    $this->name = $name;
    $this->label = $label;
    $this->factoryName = $factoryName;
  }

  public function getName(): string {
    return $this->name;
  }

  public function getLabel(): ?string {
    return $this->label;
  }

  public function getFactoryName(): string {
    return $this->factoryName;
  }

  public function createIcon(): Icon {
    return (new $this->factoryName)->get($this->getName());
  }

  public function getIconSetName(): string {
    return 'Font Awesome';
  }

}
