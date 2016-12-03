<?php

/**
 * FormInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContentInterface;

/**
 * Defines required properties for an HTML &lt;form&gt; component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @link    http://www.w3schools.com/tags/tag_form.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface FormInterface extends ContentInterface {

  /**
   * Sets the value of the method attribute
   *
   * The method attribute specifies how to send form-data (the form-data is
   * sent to the page specified in the action attribute)
   *
   * @precondition `$method == "get" | $method == "post"`
   *
   * @param  string $method the value of the method attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function setMethod($method);

  /**
   * Returns the value of the method attribute
   *
   * The method attribute specifies how to send form-data (the form-data is
   * sent to the page specified in the action attribute)
   *
   * @return string the value of the method attribute
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function getMethod();

  /**
   * Sets the value of the action attribute
   *
   * The action attribute specifies where to send the form-data when a form
   * is submitted
   *
   * @param  string $action the value of the action attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   */
  public function setAction($action);

  /**
   * Returns the value of the action attribute
   *
   * The action attribute specifies where to send the form-data when a form
   * is submitted
   *
   * @return string the value of the action attribute
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   */
  public function getAction();

  /**
   * Sets the value of the enctype attribute
   *
   * The enctype attribute specifies how the form-data should be encoded when
   * submitting it to the server.
   *
   * @param  string $enctype the value of the enctype attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_form_enctype.asp enctype attribute
   */
  public function setEnctype($enctype);

  /**
   * Returns the value of the enctype attribute
   *
   * The enctype attribute specifies how the form-data should be encoded when
   * submitting it to the server.
   *
   * @return string the value of the enctype attribute
   * @link   http://www.w3schools.com/tags/att_form_enctype.asp enctype attribute
   */
  public function getEnctype();

  /**
   * Sets the value of the name attribute
   *
   * The name attribute specifies the name of the form. The name attribute is
   * used to reference elements in a JavaScript, or to reference form data
   * after a form is submitted.
   *
   * @param  string $name the value of the name attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_form_name.asp name attribute
   */
  public function setName($name);

  /**
   * Returns the value of the name attribute
   *
   * The name attribute specifies the name of the form. The name attribute is
   * used to reference elements in a JavaScript, or to reference form data
   * after a form is submitted.
   *
   * @return string the value of the name attribute
   * @link   http://www.w3schools.com/tags/att_form_name.asp name attribute
   */
  public function getName();
  
  /**
   * Sets the autocomplete on or off
   *
   * When autocomplete is on, the browser automatically complete values based on values that the user has entered before.
   *
   * Autocomplete allows the browser to predict the value. When a user starts to type in a field,
   * the browser should display options to fill in the field, based on earlier typed values.
   *
   * @param  boolean $allow (allow the browser to predict the value)
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_form_autocomplete.asp autocomplete attribute
   */
  public function autocomplete($allow = true);

  /**
   * Sets the form as validable
   * 
   * @param  boolean $validable
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_form_novalidate.asp novalidate attribute
   */
  public function validation($validable = true);

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
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_form_target.asp target attribute
   */
  public function setTarget($target);

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
   * @return string the value of the target attribute
   * @link  http://www.w3schools.com/tags/att_form_target.asp target attribute
   */
  public function getTarget();

  /**
   * Sets the values to the input fields
   *
   * **Important:** Works only for sigle dimensional input names
   * 
   * @param  mixed[] $data
   * @param  boolean $filter true for enabling the data filtering, ans false otherwise
   * @return self for PHP Method Chaining
   */
  public function setData(array $data = [], $filter = true);

  /**
   * Returns the data presented in the input fields of the form
   * 
   * @return ArrayWrapper the data object
   */
  public function getData();
}
