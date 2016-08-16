<?php

/**
 * Textarea.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\ContainerTag as ContainerTag;
use Sphp\Html\Forms\LabelableInterface as LabelableInterface;
use Sphp\Html\Forms\LabelableTrait as LabelableTrait;

/**
 * Class models an HTML &lt;textarea&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @link    http://www.w3schools.com/tags/tag_textarea.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Textarea extends ContainerTag implements ValidableInputInterface, LabelableInterface {

  use InputTrait,
      ValidableInputTrait,
      LabelableTrait;

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "textarea";

  /**
   * Constructs a new instance
   *
   *  **Preconditions:**   <var>$rows > 0 & $cols > 0</var>
   *
   * @param  string $name name attribute value
   * @param  string $content the content of the component
   * @param  string $rows the value of the rows attribute (visible height of a text area)
   * @param  string $cols the value of the cols attribute (visible width of a text area)
   * @link   http://www.w3schools.com/tags/att_textarea_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_textarea_rows.asp rows attribute
   * @link   http://www.w3schools.com/tags/att_textarea_cols.asp cols attribute
   */
  public function __construct($name = "", $content = "", $rows = "", $cols = "") {
    parent::__construct(self::TAG_NAME, $content);
    $this->setName($name);
    if ($rows > 0) {
      $this->setRows($rows);
    }
    if ($cols > 0) {
      $this->setCols($cols);
    }
  }

  /**
   * Returns the content of the component
   *
   * @return string the content of the component
   */
  public function getValue() {
    return $this->contentToString();
  }

  /**
   * Sets the content of the component
   *
   * @param string $value the content of the component
   * @return self for PHP Method Chaining
   */
  public function setValue($value) {
    $this->replaceContent($value);
    return $this;
  }

  /**
   * Sets the value of the rows attribute
   *
   * @precondition `$rows > 0`
   * @param  int $rows the value of the rows attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_textarea_rows.asp rows attribute
   */
  public function setRows($rows) {
    $this->attrs()->set("rows", $rows);
    return $this;
  }

  /**
   * Sets the value of the cols attribute
   *
   * @precondition `$cols > 0`
   * @param  int $cols the value of the cols attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_textarea_cols.asp cols attribute
   */
  public function setCols($cols) {
    $this->attrs()->set("cols", $cols);
    return $this;
  }

  /**
   * Sets the value of the placeholder attribute
   *
   * The placeholder attribute specifies a short hint that describes the expected value of an text area
   *  (e.g. a sample value or a short description of the expected format). The short hint is displayed in
   *  the text area before the user enters a value.
   *
   * @param  string $placeholder the value of the placeholder attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_textarea_placeholder.asp placeholder attribute
   */
  public function setPlaceholder($placeholder) {
    $this->attrs()->set("placeholder", $placeholder);
    return $this;
  }

}
