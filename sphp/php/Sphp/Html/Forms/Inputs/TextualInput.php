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
 * Implements an HTML &lt;input type="text|password|email|tel| ...))"&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TextualInput extends InputTag implements TextualInputInterface {

  /**
   * Constructor
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
  public function __construct(string $type = 'text', string $name = null, $value = null, int $maxlength = null, int $size = null) {
    parent::__construct($type, $name, $value);
    if ($maxlength > 0) {
      $this->setMaxlength($maxlength);
    }
    if ($size > 0) {
      $this->setSize($size);
    }
  }

  public function setSize(int $size = null) {
    $this->attributes()->setAttribute('size', $size);
    return $this;
  }

  public function setMaxlength(int $maxlength = null) {
    $this->attributes()->setAttribute('maxlength', $maxlength);
    return $this;
  }

  public function setPlaceholder(string $placeholder = null) {
    $this->attributes()->setAttribute('placeholder', $placeholder);
    return $this;
  }

  public function autocomplete(bool $allow = true) {
    $this->attributes()->setAttribute('autocomplete', $allow ? 'on' : 'off');
    return $this;
  }

  public function setPattern(string $pattern = null) {
    $this->attributes()->setAttribute('pattern', $pattern);
    return $this;
  }

  public function getPattern(): ?string {
    return $this->attributes()->getValue('pattern');
  }

  public function hasPattern(): bool {
    return $this->attributes()->isVisible('pattern');
  }

}
