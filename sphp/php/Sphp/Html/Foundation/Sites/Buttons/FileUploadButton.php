<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\AbstractContent;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Foundation\Sites\Buttons\ButtonInterface;
use Sphp\Html\Forms\Label;
use Sphp\Html\Forms\Inputs\FileInput;
use Sphp\Html\Attributes\ClassAttribute;

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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FileUploadButton extends AbstractContent implements Input, ButtonInterface, \Sphp\Html\IdentifiableContent {

  use \Sphp\Html\Foundation\Sites\Buttons\ButtonTrait,
      \Sphp\Html\CssClassifiableTrait;

  /**
   * @var FileInput 
   */
  private $fileInput;

  /**
   * @var Label 
   */
  private $label;

  /**
   * Constructor
   *
   * @param  string|null $name the value of name attribute
   * @param  string $buttonText the value of value attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   */
  public function __construct(string $name = null, string $buttonText = 'Upload File') {
    $this->fileInput = new FileInput($name);
    $this->fileInput->cssClasses()->protectValue('show-for-sr', 'fileInput');
    $this->label = new Label($buttonText, $this->fileInput);
    $this->label->cssClasses()->protectValue('button');
  }

  public function getHtml(): string {
    return $this->label . $this->fileInput;
  }

  public function attributes() {
    return $this->label->attributes();
  }

  public function getSubmitValue() {
    return $this->fileInput->getSubmitValue();
  }

  public function setInitialValue($value) {
    $this->fileInput->setInitialValue($value);
    return $this;
  }

  public function cssClasses(): ClassAttribute {
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

  public function setName(string $name = null) {
    $this->fileInput->setName($name);
    return $this;
  }

  public function identify(int $length = 16): string {
    return $this->fileInput->identify($length);
  }

}
