<?php

/**
 * TextareaColumn.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Forms\Inputs;

use Sphp\Html\Forms\Inputs\TextareaInterface as TextareaInterface;
use Sphp\Html\Forms\Inputs\Textarea as Textarea;

/**
 * Class implements Foundation framework based textarea input component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TextareaColumn extends InputColumn implements TextareaInterface {

  /**
   * Constructs a new instance
   *
   * @precondition  `$rows > 0 & $cols > 0<`
   * @param  string $name name attribute value
   * @param  string $content the content of the component
   * @param  string $rows the value of the rows attribute (visible height of a text area)
   * @param  string $cols the value of the cols attribute (visible width of a text area)
   * @link   http://www.w3schools.com/tags/att_textarea_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_textarea_rows.asp rows attribute
   * @link   http://www.w3schools.com/tags/att_textarea_cols.asp cols attribute
   */
  public function __construct($name = "", $content = "", $rows = "", $cols = "") {
    parent::__construct(new Textarea($name, $content, $rows, $cols));
  }

  /**
   * Returns the actual input component
   * 
   * @return TextareaInterface the actual input component
   */
  public function getInput() {
    return parent::getInput();
  }

  /**
   * {@inheritdoc}
   */
  public function autocomplete($allow = true) {
    $this->getInput()->autoComplete($allow);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getMaxlength() {
    return $this->getInput()->getMaxlength();
  }

  /**
   * {@inheritdoc}
   */
  public function getSize() {
    return $this->getInput()->getSize();
  }

  /**
   * {@inheritdoc}
   */
  public function setRows($maxlength) {
    $this->getInput()->setRows($maxlength);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setPlaceholder($placeholder) {
    $this->getInput()->setPlaceholder($placeholder);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isRequired() {
    return $this->getInput()->isRequired();
  }

  /**
   * {@inheritdoc}
   */
  public function setRequired($required = true) {
    $this->getInput()->setRequired($required);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setCols($cols) {
    $this->getInput()->setCols($cols);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function wrap($wrapType) {
    $this->getInput()->wrap($wrapType);
    return $this;
  }

}
