<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implementation of an HTML input type="search" tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_input.asp w3schools API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SearchInput extends AbstractTextualInput {

  /**
   * Constructor
   *
   * @Preconditions   `0 < $size <= $maxlength`
   * @Postconditions  `attrLocked("type", "search")`
   *
   * @param  string|null $name the value of the  name attribute
   * @param  string|int|float|null $value the value of the  value attribute
   * @param  int|null $maxlength the value of the  maximum length attribute
   * @param  int|null $size the value of the  size attribute
   * @link   https://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   https://www.w3schools.com/tags/att_input_size.asp size attribute
   * @link   https://www.w3schools.com/tags/att_input_maxlength.asp maxlength attribute
   */
  public function __construct(?string $name = null, string|int|float|null $value = null, ?int $maxlength = null, ?int $size = null) {
    parent::__construct('search', $name, $value, $maxlength, $size);
  }

}
