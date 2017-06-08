<?php

/**
 * NumberInputInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Defines an HTML &lt;input type="number"&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface NumberInputInterface extends ValidableInputInterface {

  /**
   * Returns the minimum value of the input
   *
   * @return int|boolean  the minimum value of the input or `false` if minimum is not set
   * @link   http://www.w3schools.com/tags/att_input_min.asp min attribute
   */
  public function getMinimum(): int;

  /**
   * Sets the minimum value of the input
   *
   * @param  int|boolean the minimum value of the input or `false` if minimum is not set
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_min.asp min attribute
   */
  public function setMinimum(int $min);

  /**
   * Returns the value of the maxlength attribute
   *
   * @return int the value of the maxlength attribute
   * @link   http://www.w3schools.com/tags/att_input_max.asp max attribute
   */
  public function getMaximum(): int;

  /**
   * Sets the value of the maxlength attribute
   *
   *  **Preconditions:** <var>$maxlength > 0</var>
   *
   * @param  int $maxlength the value of the maxlength attribute
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_max.asp max attribute
   */
  public function setMaximum(int $maxlength);

  /**
   * Sets the value of the placeholder attribute
   *
   * The placeholder attribute specifies a short hint that describes the expected value of an input field
   *  (e.g. a sample value or a short description of the expected format). The short hint is displayed in
   * the input field before the user enters a value.
   *
   * **Note:** The placeholder attribute works with the following &lt;input&gt; types:
   *  <var>text, search, url, tel, email, and password</var>.
   *
   * @param  string $placeholder the value of the placeholder attribute
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_placeholder.asp placeholder attribute
   */
  public function setPlaceholder($placeholder);

  /**
   * Sets the autocomplete attribute's value on or off
   *
   * The autocomplete attribute specifies whether or not an input field should have autocomplete enabled.
   *
   * Autocomplete allows the browser to predict the value. When a user starts to type in a field,
   * the browser should display options to fill in the field, based on earlier typed values.
   *
   * **Note:** The autocomplete attribute works with the following &lt;input&gt; types:
   *   <var>text, search, url, tel, email, password, datepickers, range, and color</var>.
   *
   * @param  boolean $allow (allow the browser to predict the value)
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_autocomplete.asp autocomplete attribute
   */
  public function autocomplete(bool $allow = true);
}
