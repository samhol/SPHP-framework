<?php

/**
 * Textarea.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\ContainerTag;
use Sphp\Html\Forms\LabelableInterface;
use Sphp\Html\Forms\LabelableTrait;

/**
 * Class models an HTML &lt;textarea&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @link    http://www.w3schools.com/tags/tag_textarea.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Textarea extends ContainerTag implements TextareaInterface, LabelableInterface {

  use InputTrait,
      ValidableInputTrait,
      LabelableTrait;

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
  public function __construct($name = null, $content = null, $rows = "", $cols = "") {
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

  public function getSubmitValue() {
    return $this->contentToString();
  }

  public function setValue($value) {
    $this->replaceContent($value);
    return $this;
  }

  public function wrap($wrapType) {
    $this->attrs()->set('wrap', $wrapType);
    return $this;
  }

  public function setRows($rows) {
    $this->attrs()->set('rows', $rows);
    return $this;
  }

  public function setCols($cols) {
    $this->attrs()->set('cols', $cols);
    return $this;
  }

  public function setPlaceholder($placeholder) {
    $this->attrs()->set('placeholder', $placeholder);
    return $this;
  }

}
