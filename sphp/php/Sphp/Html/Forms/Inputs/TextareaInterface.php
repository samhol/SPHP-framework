<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Defines an HTML &lt;textarea&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_textarea.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface TextareaInterface extends ValidableInput {

  /**
   * specifies how the contents is to be wrapped when submitted in a form
   * 
   * Sets the value of the `wrap´ attribute
   *
   * @precondition `$wrapType == soft|hard`
   * @param  string $wrapType the value of the wrap attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_textarea_wrap.asp wrap attribute
   */
  public function wrap(string $wrapType = null);

  /**
   * Sets the value of the rows attribute
   *
   * @precondition `$rows > 0`
   * @param  int $rows the value of the rows attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_textarea_rows.asp rows attribute
   */
  public function setRows(int $rows);

  /**
   * Sets the value of the cols attribute
   *
   * @precondition `$cols > 0`
   * @param  int $cols the value of the cols attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_textarea_cols.asp cols attribute
   */
  public function setCols(int $cols);

  /**
   * Sets the value of the placeholder attribute
   *
   * The placeholder attribute specifies a short hint that describes the expected value of an text area
   *  (e.g. a sample value or a short description of the expected format). The short hint is displayed in
   *  the text area before the user enters a value.
   *
   * @param  string $placeholder the value of the placeholder attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_textarea_placeholder.asp placeholder attribute
   */
  public function setPlaceholder(string $placeholder = null);
}
