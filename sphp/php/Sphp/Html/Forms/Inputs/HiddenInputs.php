<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\AbstractContent;
use IteratorAggregate;
use Sphp\Html\Iterator;
use Traversable;

/**
 * Implements hidden data component for HTML forms
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class HiddenInputs extends AbstractContent implements IteratorAggregate, \Sphp\Html\Forms\FormController {

  /**
   * @var HiddenInput[]
   */
  private $inputs;

  /**
   * Constructor
   */
  public function __construct() {
    $this->inputs = [];
  }

  public function __destruct() {
    unset($this->inputs);
  }

  public function getHtml(): string {
    return implode($this->inputs);
  }

  /**
   * Inserts a hidden variable to the form
   *
   * @param  string $name th name of the hidden variable
   * @param  scalar $value the value of the hidden variable
   * @return HiddenInput inserted hidden input
   */
  public function insertVariable(string $name, $value): HiddenInput {
    $input = new HiddenInput($name, $value);
    $this->inputs[] = $input;
    return $input;
  }

  /**
   * Sets the hidden data to the form
   *
   * @param  string[] $vars name => value pairs
   * @return $this for a fluent interface
   */
  public function setVariables(array $vars) {
    foreach ($vars as $name => $value) {
      $this->insertVariable($name, $value);
    }
    return $this;
  }

  public function contains(string $name): bool {
    $contains = false;
    foreach ($this->inputs as $input) {
      if ($input->getName() === $name) {
        $contains = true;
        break;
      }
    }
    return $contains;
  }

  /**
   * Returns the value of the hidden variable
   *
   * @param  string $name the name of the hidden variable
   * @return Input[] the value of the hidden variable or `null`
   */
  public function getByName(string $name) {
    $result = [];
    foreach ($this->inputs as $input) {
      if ($input->getName() === $name) {
        $result[] = $input;
      }
    }
    return $result;
  }

  public function getIterator(): Traversable {
    return new Iterator($this->inputs);
  }

  public function disable(bool $disabled = true): \this {
    foreach ($this->inputs as $input) {
      $input->disable($disabled);
    }
    return $this;
  }

  /**
   * Checks whether the controller is enabled or not
   * 
   * Important: This controller is disabled only if all of its inputs are disabled.
   * 
   * @return bool true if enabled, otherwise false
   */
  public function isEnabled(): bool {
    $enabled = false;
    foreach ($this->inputs as $input) {
      $enabled = $input->isEnabled();
      if ($enabled) {
        break;
      }
    }
    return $enabled;
  }

}
