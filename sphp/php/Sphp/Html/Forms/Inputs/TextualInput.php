<?php

/**
 * TextualInput.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements an HTML &lt;input type="text|password|email|tel| ...))"&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TextualInput extends InputTag implements TextualInputInterface {

  use PatternValidableTrait;

  /**
   * Constructs a new instance
   *
   * @precondition  `0 < $size <= $maxlength`
   * @param  string $type the value of the type attribute
   * @param  string|null $name the value of the  name attribute
   * @param  string $value the value of the  value attribute
   * @param  int $maxlength the value of the  maxlength attribute
   * @param  int $size the value of the  size attribute
   * @link   http://www.w3schools.com/tags/att_input_type.asp type attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_input_maxlength.asp maxlength attribute
   * @link   http://www.w3schools.com/tags/att_input_size.asp size attribute
   */
  function __construct($type = 'text', $name = null, $value = null, int $maxlength = null, int $size = null) {
    parent::__construct($type, $name, $value);
    if ($maxlength > 0) {
      $this->setMaxlength($maxlength);
    }
    if ($size > 0) {
      $this->setSize($size);
    }
  }

  public function setSize(int $size) {
    $this->attrs()->set('size', $size);
    return $this;
  }

  public function getMaxlength() {
    return $this->attrs()->getValue('maxlength');
  }

  public function setMaxlength(int $maxlength) {
    $this->attrs()->set('maxlength', $maxlength);
    return $this;
  }

  public function setPlaceholder(string $placeholder = null) {
    $this->attrs()->set('placeholder', $placeholder);
    return $this;
  }

  public function autocomplete(bool $allow = true) {
    $this->attrs()->set('autocomplete', $allow ? 'on' : 'off');
    return $this;
  }

}

