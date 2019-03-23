<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContainerTag;
use Sphp\Html\Forms\Inputs\HiddenInput;
use Sphp\Html\TraversableContent;

/**
 * Implements an HTML &lt;form&gt; tag
 *
 * The form element represents a collection of form-associated elements, some
 * of which can represent editable values that can be submitted to a server
 * for processing.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_form.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ContainerForm extends ContainerTag implements TraversableForm {

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
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function __construct(string $action = null, string $method = null, $content = null) {
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

  public function setMethod(string $method = null) {
    $this->attributes()->setAttribute('method', $method);
    return $this;
  }

  public function getMethod(): ?string {
    return $this->attributes()->getValue("method");
  }

  public function setAction(string $url = null) {
    $this->attributes()->setAttribute('action', $url);
    return $this;
  }

  public function getAction(): ?string {
    return $this->attributes()->getValue('action');
  }

  public function setEnctype(string $enctype = null) {
    $this->attributes()->setAttribute('enctype', $enctype);
    return $this;
  }

  public function getEnctype(): ?string {
    return $this->attributes()->getValue('enctype');
  }

  public function setName(string $name = null) {
    $this->attributes()->setAttribute('name', $name);
    return $this;
  }

  public function getName(): ?string {
    return $this->attributes()->getValue('name');
  }

  public function autocomplete(bool $allow = true) {
    $this->attributes()->setAttribute('autocomplete', $allow ? 'on' : 'off');
    return $this;
  }

  public function validation(bool $validate = true) {
    $this->attributes()->setAttribute('novalidate', !$validate);
    return $this;
  }

  public function setTarget(string $target = null) {
    $this->attributes()->setAttribute('target', $target);
    return $this;
  }

  public function getTarget(): ?string {
    return $this->attributes()->getValue('target');
  }

  public function appendHiddenVariable($name, $value): HiddenInput {
    $input = new HiddenInput($name, $value);
    $this->append($input);
    return $input;
  }

  public function getNamedInputComponents(): TraversableContent {
    $search = function($element) {
      $element instanceof InputInterface && $element->isNamed();
    };
    return $this->getComponentsBy($search);
  }

  public function getHiddenInputs(): Inputs\HiddenInputs {
    $search = function($element) {
      return $element instanceof HiddenInput;
    };
    return $this->getComponentsBy($search);
  }

}
