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
 * Implements an HTML &lt;input type="file"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FileInput extends AbstractInputTag implements ValidableInput {

  /**
   * Constructor
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
    $this->attributes()->setAttribute('accept', $accept);
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
    $this->attributes()->multiple = $multiple;
    return $this;
  }

  public function setRequired(bool $required = true) {
    $this->attributes()->required = $required;
    return $this;
  }

  public function isRequired(): bool {
    return $this->attributeExists('required');
  }

}
