<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\IdentifiableContent;

/**
 * Defines an HTML &lt;input type="text|password|email|tel| ...))"&gt; tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface TextualInputInterface extends Input, IdentifiableContent, PatternValidableInput {

  /**
   * Sets the value of the size attribute
   *
   *  **Preconditions:** <var>$size > 0</var>
   *
   * @param  int $size the value of the size attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_size.asp size attribute
   */
  public function setSize(int $size);

  /**
   * Sets the value of the maxlength attribute
   *
   *  **Preconditions:** <var>$maxlength > 0</var>
   *
   * @param  int $maxlength the value of the maxlength attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_maxlength.asp maxlength attribute
   */
  public function setMaxlength(int $maxlength);

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
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_placeholder.asp placeholder attribute
   */
  public function setPlaceholder(string $placeholder = null);

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
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_input_autocomplete.asp autocomplete attribute
   */
  public function autocomplete(bool $allow = true);
}
