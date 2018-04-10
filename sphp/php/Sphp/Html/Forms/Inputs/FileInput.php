<?php

/**
 * FileInput.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements an HTML &lt;input type="file"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FileInput extends AbstractInputTag implements ValidableInput {

  /**
   * Constructs a new instance
   *
   * @param  string|null $name name attribute
   * @param  string|null $accept the accepted mime types for the file
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_accept.asp accept attribute
   */
  public function __construct(string $name = null, string $accept = null) {
    parent::__construct('file', $name);
    if ($accept !== null) {
      $this->setFileTypes($accept);
    }
  }

  /**
   * Sets the accepted mime types for the file
   *
   * @param  string $accept the accepted mime types for the file
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_accept.asp accept attribute
   */
  public function setFileTypes(string $accept) {
    $this->attributes()->set('accept', $accept);
    return $this;
  }

  /**
   * Sets whether to accept multiple files or not
   *
   * @param  boolean $multiple whether to accept multiple files or not
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_multiple.asp multiple attribute
   */
  public function multipleFiles(bool $multiple = true) {
    $this->attributes()->setBoolean('multiple', $multiple);
    return $this;
  }

  public function setRequired(bool $required = true) {
    $this->attributes()->setBoolean('required', $required);
    return $this;
  }

  public function isRequired(): bool {
    return $this->attributeExists('required');
  }

}
