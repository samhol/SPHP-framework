<?php

/**
 * SubmitButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms\Buttons;

use Sphp\Html\Forms\Inputs\IdentifiableInputInterface;
use Sphp\Html\Foundation\Sites\Buttons\ButtonInterface;
use Sphp\Html\ContentInterface;
use Sphp\Html\ContentTrait;
use Sphp\Html\Forms\Label;
use Sphp\Html\Forms\Inputs\FileInput;

/**
 * Class models &lt;input type="submit"&gt; tag as a Foundation Button in PHP
 * 
 * A submit button is used to send form data to a server.
 * The data is sent to the page specified in the form's action attribute.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API link
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-input-element W3C API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FileUploadButton implements ContentInterface, IdentifiableInputInterface, ButtonInterface {

  use ContentTrait,
      \Sphp\Html\Foundation\Sites\Buttons\ButtonTrait;

  /**
   *
   * @var FileInput 
   */
  private $fileInput;

  /**
   *
   * @var Label 
   */
  private $label;

  /**
   * Constructs a new instance
   *
   * @param  string|null $name the value of name attribute
   * @param  string|null $buttonText the value of value attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   */
  public function __construct($name = null, $buttonText = "Upload File") {
    $this->fileInput = new FileInput($name);
    $this->fileInput->cssClasses()->lock("show-for-sr");
    $this->label = new Label($buttonText, $this->fileInput);
    $this->label->cssClasses()->lock('button');
  }

  public function getHtml() {
    return $this->label . $this->fileInput;
  }

  public function attrs() {
    return $this->label->attrs();
  }

  public function getValue() {
    return $this->fileInput->getValue();
  }

  public function setValue($value) {
    $this->fileInput->setValue($value);
    return $this;
  }

  public function cssClasses() {
    return $this->label->cssClasses();
  }

  public function disable($disabled = true) {
    $this->fileInput->disable($disabled);
    return $this;
  }

  public function getName() {
    return $this->fileInput->getName();
  }

  public function isEnabled() {
    return $this->fileInput->isEnabled();
  }

  public function isNamed() {
    return $this->fileInput->isNamed();
  }

  public function setName($name) {
    $this->fileInput->setName($name);
    return $this;
  }

  public function hasId($identityName = "id") {
    return $this->fileInput->hasId($identityName);
  }

  public function identify($identityName = "id", $prefix = "id", $length = 16) {
    $this->fileInput->identify($identityName, $prefix, $length );
    return $this;
  }

}