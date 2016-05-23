<?php

/**
 * Form.php (UTF-8)
 *
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>.
 *
 * This file is part of SPH framework.
 *
 * SPH framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SPH framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SPH framework.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContainerTag as ContainerTag,
    Sphp\Html\Forms\Input\HiddenInput as HiddenInput,
    Sphp\Datastructures\ArrayWrapper as ArrayWrapper,
    Sphp\Html\Container as Container;

/**
 * Class Models an HTML &lt;form&gt; tag
 *
 * The form element represents a collection of form-associated elements, some
 * of which can represent editable values that can be submitted to a server
 * for processing.
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @version 1.3.1
 * @link    http://www.w3schools.com/tags/tag_form.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Form extends ContainerTag implements FormInterface {

  use FormTrait;

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "form";

  /**
   * Hidden input container
   *
   * @var Container
   */
  private $hiddenInputs;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * string or to an array of strings. So also an object of any class that
   * implements magic method `__toString()` is allowed.
   *
   *  **Note:** The method attribute specifies how to send form-data
   *  (the form-data is sent to the page specified in the action attribute)
   *
   * @precondition `$method == "get" | $method == "post"`
   *
   * @param  string $action where to send the form-data when the form is submitted
   * @param  string $method how to send form-data
   * @param  mixed $content tag's content
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function __construct($action = "", $method = "get", $content = null) {
    parent::__construct(self::TAG_NAME);
    $this->hiddenInputs = new Container();
    if ($content !== null) {
      $this->append($content);
    }
    if ($action != "") {
      $this->setAction($action);
    }
    if ($method != "") {
      $this->setMethod($method);
    }
  }

  /**
   * Sets the values to the input fields
   *
   * **Important:** Works only for sigle dimensional input names
   * 
   * @param  mixed[] $data
   * @param  boolean $filter true for enabling the data filtering, ans false otherwise
   * @return self for PHP Method Chaining
   */
  public function setData(array $data = [], $filter = true) {
    if ($filter) {
      $data = filter_var_array($data, \FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      //
      //
			//print_r($data);
    }
    foreach ($this->getNamedInputComponents() as $input) {
      $inputName = $input->getName();
      if (array_key_exists($inputName, $data)) {
        $input->setValue($data[$inputName]);
      }
    }
    return $this;
  }

  /**
   * Returns the data presented in the input fields of the form
   * 
   * @return ArrayWrapper the data object
   */
  public function getData() {
    $data = [];
    foreach ($this->getNamedInputComponents() as $val) {
      $a = [];
      parse_str($val->getName() . "=" . $val->getValue(), $a);
      $data = array_merge($data, $a);
    }
    return $data;
  }

  /**
   * Appends a hidden variable to the form
   *
   * The <var>$name => $value</var> pair is stored into a {@link HiddenInput} component.
   *
   * @param  string $name th name of the hidden variable
   * @param  scalar $value the value of the hidden variable
   * @return self for PHP Method Chaining
   * @see    HiddenInput
   */
  public function setHiddenVariable($name, $value) {
    $this->hiddenInputs[] = new HiddenInput($name, $value);
    return $this;
  }

  /**
   * Appends the hidden data to the form
   *
   * Appended <var>$key => $value</var> pairs are stored into 
   *  {@link HiddenInput} components.
   *
   * @param  string[] $vars name => value pairs
   * @return self for PHP Method Chaining
   * @see    HiddenInput
   */
  public function setHiddenVariables(array $vars) {
    foreach ($vars as $name => $value) {
      $this->hiddenInputs[$name] = new HiddenInput($name, $value);
    }
    return $this;
  }

  /**
   * Returns an array of sub components that match the search
   *
   * @param \Closure $rules a lambda function for testing the sub components
   * @return mixed[] matching sub components
   */
  public function getComponentsBy(\Closure $rules) {
    //echo \Sphp\Tools\ClassUtils::getRealClass($this) . " el:";
    //echo $this->count();
    $components = (new Container())
            ->append($this->hiddenInputs)
            ->append($this->content());
    return $components->getComponentsBy($rules);
  }

  /**
   * Returns all named {@link InputInterface} components in the form
   *
   * @return InputInterface[] matching components
   */
  public function getNamedInputComponents() {
    $search = function($element) {
      if ($element instanceof InputInterface && $element->isNamed()) {
        return true;
      } else {
        return false;
      }
    };
    return $this->getComponentsBy($search);
  }

  /**
   * Clears the content of the component
   *
   * @return self for PHP Method Chaining
   */
  public function clear() {
    parent::clearContent();
    $this->hiddenInputs->clearContent();
    return $this;
  }

  /**
   * Sets the value of the method attribute
   *
   * The method attribute specifies how to send form-data (the form-data is
   * sent to the page specified in the action attribute)
   *
   * @precondition `$method == "get" | $method == "post"`
   *
   * @param  string $method the value of the method attribute
   * @link   http://www.w3schools.com/tags/att_form_method.asp method attribute
   */
  public function setMethod($method) {
    return $this->setAttr("method", $method);
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
  public function getMethod() {
    return $this->getAttr("method");
  }

  /**
   * Sets the value of the action attribute
   *
   * The action attribute specifies where to send the form-data when a form is submitted.
   *
   * **Possible <var>$url</var> values:**
   *
   * * An absolute URL - points to another web site 'http://www.example.com/example.htm'
   * * A relative URL - points to a file within a web site 'example.htm'
   *
   * @param  string $url the value of the action attribute
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   */
  public function setAction($url) {
    //$this->actionParams = \Sphp\Tools\Url::getParams($url);
    //	echo "<pre>";
    //	print_r($this->actionParams);
    //	echo "</pre>";
    return parent::setAttr("action", \Sphp\Util\Strings::htmlentities($url));
  }

  /**
   * Returns the value of the action attribute
   *
   *
   * @return string the value of the action attribute
   * @link   http://www.w3schools.com/tags/att_form_action.asp action attribute
   */
  public function getAction() {
    return $this->getAttr("action");
  }

  /**
   * Sets the value of the enctype attribute.
   *
   * The enctype attribute specifies how the form-data should be encoded when submitting it to the server.
   *
   * @param  string $enctype the value of the enctype attribute
   * @link   http://www.w3schools.com/tags/att_form_enctype.asp enctype attribute
   */
  public function setEnctype($enctype) {
    return $this->setAttr("enctype", $enctype);
  }

  /**
   * Returns the value of the enctype attribute
   *
   * The enctype attribute specifies how the form-data should be encoded when submitting it to the server.
   *
   * @return string the value of the enctype attribute
   * @link   http://www.w3schools.com/tags/att_form_enctype.asp enctype attribute
   */
  public function getEnctype() {
    return $this->getAttr("enctype");
  }

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
  public function setName($name) {
    return $this->setAttr("name", $name);
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
  public function getName() {
    return $this->getAttr("name");
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
   * **<var>$target</var> values:**
   *
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
  public function setTarget($target) {
    return $this->setAttr("target", $target);
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
   * @return string the value of the target attribute
   * @link  http://www.w3schools.com/tags/att_form_target.asp target attribute
   */
  public function getTarget() {
    return $this->getAttr("target");
  }

  /**
   * Returns the content of the component as a string
   *
   * @return string content as a string
   * @throws \Exception if content parsing fails
   */
  public function contentToString() {
    return $this->hiddenInputs . parent::contentToString();
  }

}
