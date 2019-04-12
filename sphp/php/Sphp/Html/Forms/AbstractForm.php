<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Inputs\HiddenInputs;
use Sphp\Html\Forms\Inputs\HiddenInput;

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
abstract class AbstractForm extends AbstractComponent implements Form {

  /**
   * @var HiddenInputs
   */
  private $hiddenInputs;

  /**
   * Constructor
   *
   * @param  HiddenInputs $hiddenInputs
   */
  public function __construct(HiddenInputs $hiddenInputs = null) {
    if ($hiddenInputs === null) {
      $hiddenInputs = new HiddenInputs();
    }
    $this->hiddenInputs = $hiddenInputs;
    parent::__construct('form');
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

  public function useValidation(bool $validate = true) {
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

  public function appendHiddenVariable(string $name, $value): HiddenInput {
    return $this->hiddenInputs->insertVariable($name, $value);
  }

  public function getHiddenInputs(): HiddenInputs {
    return $this->hiddenInputs;
  }

}
