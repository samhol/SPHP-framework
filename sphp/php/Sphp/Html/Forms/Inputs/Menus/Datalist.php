<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Menus;

/**
 * Description of Datalist
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Datalist extends AbstractOptions {

  /**
   * Constructor
   */
  public function __construct(?iterable $data = null) {
    parent::__construct('datalist', $data);
    if ($data !== null) {
      $this->appendData($data);
    }
  }

  /**
   * Appends an array of content to the component
   * 
   * 1. a  {@link SelectContentInterface} $options is stored as such
   * 2. a `scalar[]` $options with $key => $val pairs corresponds to an array of new 
   *    {@link \Sphp\Html\Forms\Inputs\Menus\Option}($key, $val) objects
   * 3. nested arrays are converted to {@link Optgroup} objects having the root 
   *    key of the nested array as a label of the group
   * 
   * @param  iterable $data
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   */
  public function appendData(iterable $data) {
    foreach ($data as $index => $option) {
      if ($option instanceof Option) {
        $this->append($option);
      } else if (is_scalar($option) || is_null($option)) {
        $this->appendOption((string) $option);
      } else {
        throw new InvalidArgumentException('Invalid option data at ' . $index);
      }
    }
    return $this;
  }

}
