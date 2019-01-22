<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;

/**
 * Description of CoordinateAttribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
use Sphp\Html\Attributes\AbstractAttribute;
use Sphp\Html\Attributes\CollectionAttribute;
use Sphp\Stdlib\Datastructures\Arrayable;
use Countable;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Arrays;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Stdlib\Datastructures\Sequence;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;

/**
 * An implementation of a multi value HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CoordinateAttribute extends \Sphp\Html\Attributes\MultiValueAttribute {

  /**
   * Constructor
   *
   * @param string $name the name of the attribute
   * @param array $lengthRule  the separator between individual values in sequence
   */
  public function __construct(string $name, int $lengthRule = null) {
    $properties = ['type' => 'int', 'length' => $lengthRule];
    parent::__construct($name, $properties);
  }

}
