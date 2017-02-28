<?php

/**
 * TraversableFormInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms;

/**
 * Defines required properties for a traversable HTML &lt;form&gt; component
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @link    http://www.w3schools.com/tags/tag_form.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface TraversableFormInterface extends FormInterface, \Sphp\Html\TraversableInterface {

  /**
   * Sets the values to the input fields
   *
   * **Important:** Works only for sigle dimensional input names
   * 
   * @param  mixed[] $data
   * @param  boolean $filter true for enabling the data filtering, ans false otherwise
   * @return self for a fluent interface
   */
  public function setData(array $data = [], $filter = true);

  /**
   * Returns the data presented in the input fields of the form
   * 
   * @return mixed[] the data object
   */
  public function getData();

  /**
   * Appends a hidden variable into the form
   *
   * Appended <var>$name => $value</var> pair is stored into a
   *  {@link HiddenInput} object
   *
   * @param  string $name th name of the hidden variable
   * @param  scalar $value the value of the hidden variable
   * @return self for a fluent interface
   * @see    HiddenInput
   */
  public function appendHiddenVariable($name, $value);

  /**
   * Appends the hidden data to the form
   *
   * Appended <var>$key => $value</var> pairs are stored into 
   *  {@link HiddenInput} components.
   *
   * @param  string[] $vars name => value pairs
   * @return self for a fluent interface
   * @see    HiddenInput
   */
  public function appendHiddenVariables(array $vars);

  /**
   * Returns all named {@link InputInterface} components in the form
   *
   * @return ContainerInterface containing matching sub components
   */
  public function getNamedInputComponents();

  /**
   * Returns all named {@link HiddenInput} components from the form
   *
   * @return ContainerInterface containing matching sub components
   */
  public function getHiddenInputs();
}
