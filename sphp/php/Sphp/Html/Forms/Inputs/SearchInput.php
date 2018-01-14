<?php

/**
 * SearchInput.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements an HTML &lt;input type="search"&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SearchInput extends TextualInput {

  /**
   * Constructs a new instance
   *
   * @Preconditions   `0 < $size <= $maxlength`
   * @Postconditions  `attrLocked("type", "search")`
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
    parent::__construct('search', $name, $value, $maxlength, $size);
  }

}

