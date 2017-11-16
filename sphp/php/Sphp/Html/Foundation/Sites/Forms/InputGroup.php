<?php

/**
 * InputGroup.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Inputs\IdentifiableInput;

/**
 * Class InputGroup
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class InputGroup extends AbstractComponent implements IdentifiableInput {

  use \Sphp\Html\Forms\Inputs\InputWrapperTrait;

  /**
   * @var string|null
   */
  private $prefix;

  /**
   * @var string|null
   */
  private $suffix;

  /**
   * @var IdentifiableInput 
   */
  private $input;

  /**
   * 
   * @param IdentifiableInput $input
   * @param string|null $prefix the content of the prefix
   * @param string|null $suffix the content of the suffix
   */
  public function __construct(IdentifiableInput $input, $prefix = null, $suffix = null) {
    parent::__construct('div');
    $this->cssClasses()->protect("input-group");
    $this->prefix = $prefix;
    $this->input = $input;
    $this->suffix = $suffix;
    $this->input->cssClasses()->protect("input-group-field");
  }

  /**
   * 
   * 
   * @return IdentifiableInput
   */
  public function getInput() {
    return $this->input;
  }

  /**
   * Sets the content of the prefix
   * 
   * `null` value hides the prefix
   * 
   * @param  string|null $prefix the content of the prefix
   * @return $this for a fluent interface
   */
  public function setPrefix($prefix = null) {
    $this->prefix = $prefix;
    return $this;
  }

  /**
   * Sets the content of the suffix
   * 
   * `null` value hides the suffix
   * 
   * @param  string|null $suffix the content of the suffix
   * @return $this for a fluent interface
   */
  public function setSuffix($suffix = null) {
    $this->suffix = $suffix;
    return $this;
  }

  public function contentToString(): string {
    $a = function ($v) {
      if ($v !== null) {
        return '<span class="input-group-label">' . $v . '</span>';
      } else {
        return "";
      }
    };
    return $a($this->prefix) . $this->input->getHtml() . $a($this->suffix);
  }

  public function getSubmitValue() {
    $this->getInput()->getSubmitValue();
  }

}
