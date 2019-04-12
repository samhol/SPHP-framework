<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use Sphp\Html\Component;
use Sphp\Html\Forms\Inputs\HiddenInput;
use Sphp\Html\Forms\Inputs\HiddenInputs;

/**
 * Defines required properties for an HTML &lt;form&gt; component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_form.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Form extends Component {

  /**
   * Sets the value of the method attribute
   *
   * The method attribute specifies how to send form-data (the form-data is
   * sent to the page specified in the action attribute)
   *
   * @precondition `$method == "get" | $method == "post"`
   *
   * @param  string|null $method the value of the method attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function setMethod(string $method = null);

  /**
   * Returns the value of the method attribute
   *
   * The method attribute specifies how to send form-data (the form-data is
   * sent to the page specified in the action attribute)
   *
   * @return string|null the value of the method attribute
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function getMethod(): ?string;

  /**
   * Sets the value of the action attribute
   *
   * The action attribute specifies where to send the form-data when a form
   * is submitted
   *
   * @param  string $action the value of the action attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   */
  public function setAction(string $action = null);

  /**
   * Returns the value of the action attribute
   *
   * The action attribute specifies where to send the form-data when a form
   * is submitted
   *
   * @return string|null the value of the action attribute
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   */
  public function getAction(): ?string;

  /**
   * Sets the value of the enctype attribute
   *
   * The enctype attribute specifies how the form-data should be encoded when
   * submitting it to the server.
   *
   * @param  string $enctype the value of the enctype attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_form_enctype.asp enctype attribute
   */
  public function setEnctype(string $enctype = null);

  /**
   * Returns the value of the enctype attribute
   *
   * The enctype attribute specifies how the form-data should be encoded when
   * submitting it to the server.
   *
   * @return string|null the value of the enctype attribute
   * @link   http://www.w3schools.com/tags/att_form_enctype.asp enctype attribute
   */
  public function getEnctype(): ?string;

  /**
   * Sets the value of the name attribute
   *
   * The name attribute specifies the name of the form. The name attribute is
   * used to reference elements in a JavaScript, or to reference form data
   * after a form is submitted.
   *
   * @param  string $name the value of the name attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_form_name.asp name attribute
   */
  public function setName(string $name = null);

  /**
   * Returns the value of the name attribute
   *
   * The name attribute specifies the name of the form. The name attribute is
   * used to reference elements in a JavaScript, or to reference form data
   * after a form is submitted.
   *
   * @return string|null the value of the name attribute
   * @link   http://www.w3schools.com/tags/att_form_name.asp name attribute
   */
  public function getName(): ?string;

  /**
   * Sets the autocomplete on or off
   *
   * When autocomplete is on, the browser automatically complete values based on values that the user has entered before.
   *
   * Autocomplete allows the browser to predict the value. When a user starts to type in a field,
   * the browser should display options to fill in the field, based on earlier typed values.
   *
   * @param  boolean $allow (allow the browser to predict the value)
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_form_autocomplete.asp autocomplete attribute
   */
  public function autocomplete(bool $allow = true);

  /**
   * Sets the form as validable
   * 
   * @param  boolean $validable
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_form_novalidate.asp novalidate attribute
   */
  public function useValidation(bool $validable = true);

  /**
   * Sets the value of the target attribute
   *
   * **Notes:**
   *
   * The target attribute specifies a name or a keyword that indicates where
   * to display the response that is received after submitting the form. The
   * target attribute defines a name of, or keyword for, a browsing context
   * (e.g. tab, window, or inline frame).
   *
   * **<var>$target</var> values:**
   *
   * * <var>_blank</var>: The response is displayed in a new window or tab
   * * <var>_self</var>: The response is displayed in the same frame (this is default)
   * * <var>_parent</var>: The response is displayed in the parent frame
   * * <var>_top</var>: The response is displayed in the full body of the window
   * * <var>framename</var>: The response is displayed in a named iframe
   * 
   * @param  string $target the value of the target attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_form_target.asp target attribute
   */
  public function setTarget(string $target = null);

  /**
   * Returns the value of the target attribute
   *
   * **Notes:**
   *
   * The target attribute specifies a name or a keyword that indicates where
   * to display the response that is received after submitting the form. The
   * target attribute defines a name of, or keyword for, a browsing context
   * (e.g. tab, window, or inline frame).
   *
   * @return string|null the value of the target attribute
   * @link  http://www.w3schools.com/tags/att_form_target.asp target attribute
   */
  public function getTarget(): ?string;

  /**
   * Appends a hidden variable into the form
   *
   * @param  string $name the name of the hidden variable
   * @param  scalar $value the value of the hidden variable
   * @return $this for a fluent interface
   * @see    HiddenInput
   */
  public function appendHiddenVariable(string $name, $value): HiddenInput;

  /**
   * Returns all named {@link HiddenInput} components from the form
   *
   * @return HiddenInputs containing matching sub components
   */
  public function getHiddenInputs(): HiddenInputs;
}
