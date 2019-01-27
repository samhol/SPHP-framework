<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;
use Sphp\Html\Attributes\MultiValueAttribute;
/**
 * An implementation of a multi value HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CoordinateAttribute extends MultiValueAttribute {

  /**
   * Constructor
   *
   * @param string $name the name of the attribute
   * @param int $length number of individual coordinates required
   */
  public function __construct(string $name, int $length = null) {
    $properties = ['type' => 'int', 'length' => $length, 'delim' => ','];
    $p = new \Sphp\Html\Attributes\MultiValueParser($properties);
    parent::__construct($name, $p);
  }

}
