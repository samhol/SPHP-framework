<?php

/**
 * MessageInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n\Messages; 

use Sphp\I18n\TranslatorAwareInterface;

/**
 * Defines properties for a translatable message object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface MessageInterface extends TranslatorAwareInterface {

  /**
   * Returns the template used
   * 
   * @return TemplateInterface the template used
   */
  public function getTemplate(): TemplateInterface;

  /**
   * Sets the arguments used for message
   *
   * @param  array $args the arguments
   * @return self for a fluent interface
   */
  public function setArguments(array $args);

  /**
   *
   * @return boolean
   */
  public function hasArguments(): bool;

  /**
   * Sets the arguments used for the message
   *
   * @return array $args the arguments
   */
  public function getArguments();


  /**
   *
   * @param  bool $translateArguments
   * @return self for a fluent interface
   */
  public function translateArguments(bool $translateArguments = true);


  /**
   *
   * @return boolean
   */
  public function translatesArguments(): bool;
  /**
   * Returns the message as formatted and translated string
   *
   * @return string the message as formatted and translated string
   */
  public function translate();

  /**
   * Returns the message object as a string
   *
   * @return string the message object as a string
   */
  public function __toString();
}
