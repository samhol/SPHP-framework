<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Trait implements parts of the {@link FormInterface}
 *
 * The form element represents a collection of form-associated elements, some
 * of which can represent editable values that can be submitted to a server
 * for processing.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_form.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
trait FormTrait {

  /**
   * Returns the attribute manager attached to the component
   * 
   * @return HtmlAttributeManager the attribute manager
   */
  abstract public function attributes(): HtmlAttributeManager;

  /**
   * Sets the value of the method attribute
   *
   * The method attribute specifies how to send form-data (the form-data is
   * sent to the page specified in the action attribute)
   *
   * @precondition `$method == "get|post"`
   * @param  string|null $method the value of the method attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function setMethod(string $method = null) {
    $this->attributes()->setAttribute('method', $method);
    return $this;
  }

  /**
   * Returns the value of the method attribute.
   *
   * The method attribute specifies how to send form-data (the form-data is
   * sent to the page specified in the action attribute)
   *
   * @return string the value of the method attribute
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function getMethod(): ?string {
    return $this->attributes()->getValue("method");
  }

  /**
   * Sets the value of the action attribute
   *
   * The action attribute specifies where to send the form-data when a form is submitted.
   *
   * **Possible `$url` values:**
   *
   * * An absolute URL - points to another web site 'http://www.example.com/example.htm'
   * * A relative URL - points to a file within a web site 'example.htm'
   *
   * @param  string $url the value of the action attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   */
  public function setAction(string $url = null) {
    $this->attributes()->setAttribute('action', $url);
    return $this;
  }

  /**
   * Returns the value of the action attribute
   *
   * @return string|null the value of the action attribute
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   */
  public function getAction(): ?string {
    return $this->attributes()->getValue('action');
  }

  /**
   * Sets the value of the enctype attribute.
   *
   * The enctype attribute specifies how the form-data should be encoded when submitting it to the server.
   *
   * @param  string $enctype the value of the enctype attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_form_enctype.asp enctype attribute
   */
  public function setEnctype(string $enctype = null) {
    $this->attributes()->setAttribute('enctype', $enctype);
    return $this;
  }

  /**
   * Returns the value of the enctype attribute
   *
   * The enctype attribute specifies how the form-data should be encoded when submitting it to the server.
   *
   * @return string the value of the enctype attribute
   * @link   http://www.w3schools.com/tags/att_form_enctype.asp enctype attribute
   */
  public function getEnctype(): ?string {
    return $this->attributes()->getValue('enctype');
  }

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
  public function setName(string $name = null) {
    $this->attributes()->setAttribute('name', $name);
    return $this;
  }

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
  public function getName(): ?string {
    return $this->attributes()->getValue('name');
  }

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
  public function autocomplete(bool $allow = true) {
    $this->attributes()->setAttribute('autocomplete', $allow ? 'on' : 'off');
    return $this;
  }

  /**
   * 
   * @param  boolean $validate
   * @return $this for a fluent interface
   */
  public function validation(bool $validate = true) {
    $this->attributes()->setAttribute('novalidate', !$validate);
    return $this;
  }

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
   * **`$target` values:**
   *
   * 
   * * `_blank`: The response is displayed in a new window or tab
   * * `_self`: The response is displayed in the same frame (this is default)
   * * `_parent`: The response is displayed in the parent frame
   * * `_top`: The response is displayed in the full body of the window
   * * `framename`: The response is displayed in a named iframe
   * 
   * @param  string $target the value of the target attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_form_target.asp target attribute
   */
  public function setTarget(string $target = null) {
    $this->attributes()->setAttribute('target', $target);
    return $this;
  }

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
  public function getTarget(): ?string {
    return $this->attributes()->getValue('target');
  }

}
