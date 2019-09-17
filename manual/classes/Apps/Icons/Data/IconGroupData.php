<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons\Data;

use Sphp\Stdlib\Datastructures\DataObject;

/**
 * Implementation of IconGroupData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IconGroupData {

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
  
  private $searchTerms;

  public function __construct(iterable $data) {
    foreach ($data as $key => $value) {
      if (property_exists(static::class, $key)) {
        $this->$key = $value;
      }
    }
  }

  public function getName() {
    return $this->name;
  }

  public function getLabel() {
    return $this->label;
  }

  public function getFactoryName() {
    return $this->factoryName;
  }

}
