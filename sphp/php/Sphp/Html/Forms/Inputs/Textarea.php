<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\SimpleTag;

/**
 * Implementation of an HTML textarea tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_textarea.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Textarea extends SimpleTag implements ValidableInput {

  /**
   * Constructor
   *
   * @precondition  `$rows > 0 & $cols > 0`
   * @param  string $name name attribute value
   * @param  string $content the content of the component
   * @param  string $rows the value of the rows attribute (visible height of a text area)
   * @param  string $cols the value of the cols attribute (visible width of a text area)
   * @link   https://www.w3schools.com/tags/att_textarea_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_textarea_rows.asp rows attribute
   * @link   https://www.w3schools.com/tags/att_textarea_cols.asp cols attribute
   */
  public function __construct(?string $name = null, $content = null, ?int $rows = null, ?int $cols = null) {
    parent::__construct('textarea', $content);
    $this->setName($name);
    if ($rows > 0) {
      $this->setRows($rows);
    }
    if ($cols > 0) {
      $this->setCols($cols);
    }
  }

  public function disable(bool $disabled = true) {
    $this->attributes()->setAttribute('disabled', $disabled);
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->isVisible('disabled');
  }

  public function getName(): ?string {
    return $this->attributes()->getValue('name');
  }

  public function setName(?string $name) {
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

  /**
   * specifies how the contents is to be wrapped when submitted in a form
   * 
   * Sets the value of the `wrap´ attribute
   *
   * @precondition `$wrapType == soft|hard`
   * @param  string|null $wrapType the value of the wrap attribute
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_textarea_wrap.asp wrap attribute
   */
  public function wrap(?string $wrapType) {
    $this->attributes()->setAttribute('wrap', $wrapType);
    return $this;
  }

  /**
   * Sets the value of the rows attribute
   *
   * @precondition `$rows > 0`
   * @param  int|null $rows the value of the rows attribute
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_textarea_rows.asp rows attribute
   */
  public function setRows(?int $rows) {
    $this->attributes()->setAttribute('rows', $rows);
    return $this;
  }

  /**
   * Sets the value of the cols attribute
   *
   * @precondition `$cols > 0`
   * @param  int|null $cols the value of the cols attribute
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_textarea_cols.asp cols attribute
   */
  public function setCols(?int $cols) {
    $this->attributes()->setAttribute('cols', $cols);
    return $this;
  }

  /**
   * Sets the value of the placeholder attribute
   *
   * The placeholder attribute specifies a short hint that describes the expected value of an text area
   *  (e.g. a sample value or a short description of the expected format). The short hint is displayed in
   *  the text area before the user enters a value.
   *
   * @param  string|null $placeholder the value of the placeholder attribute
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_textarea_placeholder.asp placeholder attribute
   */
  public function setPlaceholder(?string $placeholder) {
    $this->attributes()->setAttribute('placeholder', $placeholder);
    return $this;
  }

  public function setRequired(bool $required = true) {
    $this->attributes()->setAttribute('required', $required);
    return $this;
  }

  public function isRequired(): bool {
    return $this->attributeExists('required');
  }

}
