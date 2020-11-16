<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Stdlib\Strings;

/**
 * Implements a regular expression validable attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PatternAttribute extends ScalarAttribute {

  /**
   * @var string
   */
  private $pattern;

  /**
   * Constructor
   *
   * @param string $name the name of the attribute
   * @param string $pattern 
   */
  public function __construct(string $name, string $pattern = '//') {
    $this->pattern = $pattern;
    parent::__construct($name);
  }

  public function isValidValue($value): bool {
    return parent::isValidValue($value) && Strings::match((string) $value, $this->pattern);
  }

}
