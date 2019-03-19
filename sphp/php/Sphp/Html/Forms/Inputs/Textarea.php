<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\SimpleTag;

/**
 * Implements an HTML &lt;textarea&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_textarea.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Textarea extends SimpleTag implements TextareaInterface {

  /**
   * Constructor
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
    $this->attributes()->getObjectMap()->mapType('rows', \Sphp\Html\Attributes\IntegerAttribute::class, 0);
    $this->attributes()->getObjectMap()->mapType('cols', \Sphp\Html\Attributes\IntegerAttribute::class, 0);
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
    $this->attributes()->disabled = $disabled;
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->isVisible('disabled');
  }

  public function getName(): string {
    return (string) $this->attributes()->getValue('name');
  }

  public function setName(string $name = null) {
    $this->attributes()->setAttribute('name', $name);
    return $this;
  }

  public function isNamed(): bool {
    return $this->attributes()->isVisible('name');
  }

  public function getSubmitValue() {
    return $this->getContent();
  }

  public function setInitialValue($value) {
    $this->setContent($value);
    return $this;
  }

  public function wrap(string $wrapType = null) {
    $this->attributes()->setAttribute('wrap', $wrapType);
    return $this;
  }

  public function setRows(int $rows = null) {
    $this->attributes()->rows($rows);
    return $this;
  }

  public function setCols(int $cols = null) {
    $this->attributes()->cols($cols);
    return $this;
  }

  public function setPlaceholder(string $placeholder = null) {
    $this->attributes()->setAttribute('placeholder', $placeholder);
    return $this;
  }

  public function setRequired(bool $required = true) {
    $this->attributes()->required = $required;
    return $this;
  }

  public function isRequired(): bool {
    return $this->attributeExists('required');
  }

}
