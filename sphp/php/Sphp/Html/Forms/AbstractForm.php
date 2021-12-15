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

use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Inputs\HiddenInputs;
use Sphp\Html\Forms\Inputs\HiddenInput;

/**
 * Implementation of an HTML form tag
 *
 * The form element represents a collection of form-associated elements, some
 * of which can represent editable values that can be submitted to a server
 * for processing.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_form.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractForm extends AbstractComponent implements Form {

  private HiddenInputs $hiddenInputs;

  /**
   * Constructor
   *
   * @param  HiddenInputs|null $hiddenInputs
   */
  public function __construct(?HiddenInputs $hiddenInputs = null) {
    if ($hiddenInputs === null) {
      $hiddenInputs = new HiddenInputs();
    }
    $this->hiddenInputs = $hiddenInputs;
    parent::__construct('form');
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

  public function appendHiddenVariable(string $name, $value): HiddenInput {
    return $this->hiddenInputs->insertVariable($name, $value);
  }

  public function getHiddenInputs(): HiddenInputs {
    return $this->hiddenInputs;
  }

}
