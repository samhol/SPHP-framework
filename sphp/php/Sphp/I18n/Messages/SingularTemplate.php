<?php

/**
 * SingularTemplate.php (UTF-8)
 * Copyright (c) 2010 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n\Messages;

use Sphp\I18n\TranslatorInterface;

/**
 * Implements a translatable message object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2010-09-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SingularTemplate extends AbstractTemplate {

  /**
   * original raw message
   *
   * @var string
   */
  private $message;

  /**
   * Constructs a new instance
   *
   * @param string $message
   * @param TranslatorInterface $translator optional translator
   */
  public function __construct($message, TranslatorInterface $translator) {
    parent::__construct($translator);
    $this->message = $message;
  }

  /**
   * Returns the message as translated string
   *
   * @return string the message as formatted and translated string
   */
  public function translate(): string {
    return $this->getTranslator()->get($this->message);
  }

}