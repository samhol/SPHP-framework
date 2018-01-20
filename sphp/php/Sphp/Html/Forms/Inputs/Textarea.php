<?php

/**
 * Textarea.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\SimpleContainerTag;

/**
 * Implements an HTML &lt;textarea&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_textarea.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Textarea extends SimpleContainerTag implements TextareaInterface {

  /**
   * Constructs a new instance
   *
   * @precondition  `$rows > 0 & $cols > 0`
   * @param  string $name name attribute value
   * @param  string $content the content of the component
   * @param  string $rows the value of the rows attribute (visible height of a text area)
   * @param  string $cols the value of the cols attribute (visible width of a text area)
   * @link   http://www.w3schools.com/tags/att_textarea_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_textarea_rows.asp rows attribute
   * @link   http://www.w3schools.com/tags/att_textarea_cols.asp cols attribute
   */
  public function __construct(string $name = null, $content = null, int $rows = null, int $cols = null) {
    parent::__construct('textarea', $content);
    if ($name !== null) {
      $this->setName($name);
    }
    if ($rows > 0) {
      $this->setRows($rows);
    }
    if ($cols > 0) {
      $this->setCols($cols);
    }
  }

  public function disable(bool $disabled = true) {
    $this->attributes()->setBoolean('disabled', $disabled);
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->exists('disabled');
  }

  public function getName(): string {
    return (string) $this->attributes()->getValue('name');
  }

  public function setName(string $name) {
    $this->attributes()->set('name', $name);
    return $this;
  }

  public function isNamed(): bool {
    return $this->attributes()->exists('name');
  }

  public function getSubmitValue() {
    return $this->getContent();
  }

  public function setSubmitValue($value) {
    $this->setContent($value);
    return $this;
  }

  public function wrap(string $wrapType = null) {
    $this->attributes()->set('wrap', $wrapType);
    return $this;
  }

  public function setRows(int $rows) {
    $this->attributes()->setInteger('rows', $rows);
    return $this;
  }

  public function setCols(int $cols) {
    $this->attributes()->setInteger('cols', $cols);
    return $this;
  }

  public function setPlaceholder(string $placeholder = null) {
    $this->attributes()->set('placeholder', $placeholder);
    return $this;
  }

  public function setRequired(bool $required = true) {
    $this->attributes()->setBoolean('required', $required);
    return $this;
  }

  public function isRequired(): bool {
    return $this->attributeExists('required');
  }

}
