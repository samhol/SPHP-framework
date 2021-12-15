<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters\Inputs;

/**
 * The IntInputFilter class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class IntegerFilter {

  /**
   * @var array
   */
  private $options;

  /**
   * @var int
   */
  private $type;

  public function __construct(int $type = INPUT_GET) {
    $this->options = [];
    $this->type = $type;
  }

  public function setRange(int $min = null, int $max = null) {
    $this->options['min_range'] = $min;
    $this->options['max_range'] = $max;
    return $this;
  }

  public function setDefault(int $default = null) {
    $this->options['default'] = $default;
  }

  public function setType(int $type = INPUT_GET) {
    $this->type = $type;
  }

  public function filter(string $name): ?int {
    $options = ['options' => $this->options];
    return filter_input($this->type, $name, FILTER_VALIDATE_INT, $options);
  }

}
