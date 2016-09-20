<?php

/**
 * SubmitButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Forms\Buttons;

use Sphp\Html\ContentInterface as ContentInterface;
use Sphp\Html\ContentTrait as ContentTrait;
use Sphp\Html\Forms\Label as Label;
use Sphp\Html\Forms\Inputs\FileInput as FileInput;

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
class FileUploadButton implements ContentInterface, \Sphp\Html\Forms\Inputs\IdentifiableInputInterface, \Sphp\Html\Foundation\F6\Buttons\ButtonInterface {

  use ContentTrait,
      \Sphp\Html\Foundation\F6\Buttons\ButtonTrait;

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
    $this->label->cssClasses()->lock("button");
  }

  /**
   * {@inheritdoc}
   */
  public function getHtml() {
    return $this->label . $this->fileInput;
  }

  /**
   * {@inheritdoc}
   */
  public function attrs() {
    return $this->label->attrs();
  }

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    return $this->fileInput->getValue();
  }

  /**
   * {@inheritdoc}
   */
  public function setValue($value) {
    $this->fileInput->setValue($value);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function cssClasses() {
    return $this->label->cssClasses();
  }

  /**
   * {@inheritdoc}
   */
  public function disable($disabled = true) {
    $this->fileInput->disable($disabled);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->fileInput->getName();
  }

  /**
   * {@inheritdoc}
   */
  public function isEnabled() {
    return $this->fileInput->isEnabled();
  }

  /**
   * {@inheritdoc}
   */
  public function isNamed() {
    return $this->fileInput->isNamed();
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->fileInput->setName($name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function hasId() {
    return $this->fileInput->hasId();
  }

  /**
   * {@inheritdoc}
   */
  public function identify($seed = "id") {
    $this->fileInput->identify($seed);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setId($id) {
    $this->fileInput->setId($id);
    return $this;
  }

}
