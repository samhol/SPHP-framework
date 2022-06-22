<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContainerTag;
use Sphp\Html\TraversableContent;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Inputs\HiddenInput;

/**
 * Implementation of an HTML form tag
 *
 * The form element represents a collection of form-associated elements, some
 * of which can represent editable values that can be submitted to a server
 * for processing.
 *
 * @method Inputs\TextInput appendTextInput(?string $name = null, $value = null, ?int $maxlength = null, ?int $size = null) Appends a text input
 * @method Inputs\HiddenInput appendHiddenInput(?string $name = null, $value = null) Appends a hidden input
 * @method Inputs\Textarea appendTextarea(?string $name = null, string|int|float|null $content = null, ?int $rows = null, ?int $cols = null) Appends a hidden input
 * @method Inputs\EmailInput appendEmailInput(?string $name = null, $value = null) Appends an email input
 * @method Inputs\Menus\Select appendSelect(?string $name = null) Appends a select menu
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_form.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Form extends ContainerTag implements HtmlForm {

  /**
   * Constructor
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * string or to an array of strings. So also an object of any class that
   * implements magic method `__toString()` is allowed.
   *
   *  **Note:** The method attribute specifies how to send form-data
   *  (the form-data is sent to the page specified in the action attribute)
   *
   * @precondition `$method == "get|post"`
   * @param  string|null $action where to send the form-data when the form is submitted
   * @param  string|null $method how to send form-data
   * @param  mixed $content tag's content
   * @link   https://www.w3schools.com/tags/att_form_action.asp action attribute
   * @link   https://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function __construct(?string $action = null, ?string $method = null, mixed $content = null) {
    parent::__construct('form');
    if ($content !== null) {
      $this->append($content);
    }
    if ($action !== null) {
      $this->setAction($action);
    }
    if ($method !== null) {
      $this->setMethod($method);
    }
  }

  public function setMethod(?string $method) {
    $this->attributes()->setAttribute('method', $method);
    return $this;
  }

  public function getMethod(): ?string {
    return $this->attributes()->getValue('method');
  }

  public function setAction(?string $url) {
    $this->attributes()->setAttribute('action', $url);
    return $this;
  }

  public function getAction(): ?string {
    return $this->attributes()->getStringValue('action');
  }

  public function setEnctype(?string $enctype) {
    $this->attributes()->setAttribute('enctype', $enctype);
    return $this;
  }

  public function getEnctype(): ?string {
    return $this->attributes()->getStringValue('enctype');
  }

  public function setName(?string $name) {
    $this->attributes()->setAttribute('name', $name);
    return $this;
  }

  public function getName(): ?string {
    return $this->attributes()->getStringValue('name');
  }

  public function autocomplete(bool $allow = true) {
    $this->attributes()->setAttribute('autocomplete', $allow ? 'on' : 'off');
    return $this;
  }

  public function useValidation(bool $validate = true) {
    $this->attributes()->setAttribute('novalidate', !$validate);
    return $this;
  }

  public function setTarget(?string $target) {
    $this->attributes()->setAttribute('target', $target);
    return $this;
  }

  public function getTarget(): ?string {
    return $this->attributes()->getValue('target');
  }

  /**
   * Returns all HiddenInput components from the form
   *
   * @return TraversableContent containing matching sub components
   * @see    HiddenInput
   */
  public function getHiddenInputs(): TraversableContent {
    $search = function ($element): bool {
      return $element instanceof HiddenInput;
    };
    return $this->getComponentsBy($search);
  }

  /**
   * Returns all named Input components from the form
   *
   * @return TraversableContent containing matching sub components
   * @see    Input
   */
  public function getNamedInputComponents(): TraversableContent {
    $search = function ($element): bool {
      return $element instanceof Input && $element->isNamed();
    };
    return $this->getComponentsBy($search);
  }

}
