<?php

/**
 * MessageInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n\Messages;

use Sphp\I18n\Translatable;

/**
 * Defines properties for a translatable message object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface MessageInterface extends Translatable {

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
   * Returns the arguments used for the message
   *
   * @return array $args the arguments
   */
  public function getArguments(): array;

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
}
