<?php

/**
 * FileInput.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Class models an HTML &lt;input type="file"&gt; tag
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-03-10
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FileInput extends AbstractInputTag implements ValidableInputInterface {

  use InputTrait,
      ValidableInputTrait;

  /**
   * Constructs a new instance
   *
   * @param  string|null $name name attribute
   * @param  string|null $accept the accepted mimetypes for the file
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_accept.asp accept attribute
   */
  public function __construct($name = null, $accept = null) {
    parent::__construct('file', $name);
    if ($accept !== null) {
      $this->setFileTypes($accept);
    }
  }

  /**
   * Sets the accepted mimetypes for the file
   *
   * @param  string $accept the accepted mimetypes for the file
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_input_accept.asp accept attribute
   */
  public function setFileTypes($accept) {
    $this->attrs()->set('accept', $accept);
    return $this;
  }

  /**
   * Sets whether to accept multiple files or not
   *
   * @param  boolean $multiple whether to accept multiple files or not
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_input_multiple.asp multiple attribute
   */
  public function multipleFiles($multiple = true) {
    $this->attrs()->set('multiple', (bool) $multiple);
    return $this;
  }

}
