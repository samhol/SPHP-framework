<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements an HTML &lt;input type="text"&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TextInput extends TextualInput {

  /**
   * Constructor
   *
   * @Preconditions   `0 < $size <= $maxlength`
   * @Postconditions  <var>attrLocked("type", "text")</var>
   *
   * @param  string $name the value of the  name attribute
   * @param  string $value the value of the  value attribute
   * @param  int|null $maxlength the value of the  maximum length attribute
   * @param  int|null $size the value of the  size attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_input_size.asp size attribute
   * @link   http://www.w3schools.com/tags/att_input_maxlength.asp maxlength attribute
   */
  public function __construct(string $name = null, $value = null, int $maxlength = null, int $size = null) {
    parent::__construct('text', $name, $value, $maxlength, $size);
  }

}

