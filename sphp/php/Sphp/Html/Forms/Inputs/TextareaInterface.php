<?php

/**
 * TextareaInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Defines an HTML &lt;textarea&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @link    http://www.w3schools.com/tags/tag_textarea.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TextareaInterface extends ValidableInputInterface {

  /**
   * specifies how the contents is to be wrapped when submitted in a form
   * 
   * Sets the value of the `wrap´ attribute
   *
   * @precondition `$wrapType == soft|hard`
   * @param  int $wrapType the value of the wrap attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_textarea_wrap.asp wrap attribute
   */
  public function wrap($wrapType);

  /**
   * Sets the value of the rows attribute
   *
   * @precondition `$rows > 0`
   * @param  int $rows the value of the rows attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_textarea_rows.asp rows attribute
   */
  public function setRows($rows);

  /**
   * Sets the value of the cols attribute
   *
   * @precondition `$cols > 0`
   * @param  int $cols the value of the cols attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_textarea_cols.asp cols attribute
   */
  public function setCols($cols);

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
  public function setPlaceholder($placeholder);
}
