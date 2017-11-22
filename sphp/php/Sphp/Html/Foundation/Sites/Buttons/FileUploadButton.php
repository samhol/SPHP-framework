<?php

/**
 * FileUploadButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\Forms\Inputs\IdentifiableInput;
use Sphp\Html\Foundation\Sites\Buttons\ButtonInterface;
use Sphp\Html\Forms\Label;
use Sphp\Html\Forms\Inputs\FileInput;

/**
 * Implements &lt;input type="file"&gt; tag as a Foundation Button
 * 
 * A submit button is used to send form data to a server.
 * The data is sent to the page specified in the form's action attribute.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-input-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FileUploadButton implements IdentifiableInput, ButtonInterface {

  use \Sphp\Html\ContentTrait,
      \Sphp\Html\Foundation\Sites\Buttons\ButtonTrait;

  /**
   * @var FileInput 
   */
  private $fileInput;

  /**
   * @var Label 
   */
  private $label;

  /**
   * Constructs a new instance
   *
   * @param  string|null $name the value of name attribute
   * @param  string $buttonText the value of value attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   */
  public function __construct(string $name = null, string $buttonText = 'Upload File') {
    $this->fileInput = new FileInput($name);
    $this->fileInput->cssClasses()->protect('show-for-sr', 'fileInput');
    $this->label = new Label($buttonText, $this->fileInput);
    $this->label->cssClasses()->protect('button');
  }

  public function getHtml(): string {
    return $this->label . $this->fileInput;
  }

  public function attrs() {
    return $this->label->attrs();
  }

  public function getSubmitValue() {
    return $this->fileInput->getSubmitValue();
  }

  public function setValue($value) {
    $this->fileInput->setValue($value);
    return $this;
  }

  public function cssClasses() {
    return $this->label->cssClasses();
  }

  public function disable(bool $disabled = true) {
    $this->fileInput->disable($disabled);
    return $this;
  }

  public function getName() {
    return $this->fileInput->getName();
  }

  public function isEnabled(): bool {
    return $this->fileInput->isEnabled();
  }

  public function isNamed(): bool {
    return $this->fileInput->isNamed();
  }

  public function setName(string $name) {
    $this->fileInput->setName($name);
    return $this;
  }

  public function hasId(): bool {
    return $this->fileInput->hasId();
  }

  public function identify(int $length = 16): string {
    return $this->fileInput->identify($length);
  }

}
