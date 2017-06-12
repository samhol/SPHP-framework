<?php

/**
 * Message.php (UTF-8)
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
class Message extends AbstractMessage {

  /**
   * @var TranslatorInterface 
   */
  private static $translator;

  /**
   * 
   * @param TranslatorInterface $translator
   */
  public static function setDefaultTranslator(TranslatorInterface $translator) {
    self::$translator = $translator;
  }

  /**
   * 
   * @return TranslatorInterface
   */
  public static function getDefaultTranslator() {
    if (self::$translator === null) {
      self::$translator = new \Sphp\I18n\Gettext\Translator();
    }
    return self::$translator;
  }

  /**
   * 
   * @param string $message
   * @param array $args
   * @param TranslatorInterface $translator
   * @return self new instance
   */
  public static function singular(string $message, array $args = [], TranslatorInterface $translator = null) {
    if ($translator === null) {
      $translator = static::getDefaultTranslator();
    }
    $template = new SingularTemplate($message, $translator);
    return new static($template, $args);
  }

  /**
   * 
   * @param string $singular
   * @param string $plural
   * @param bool $isPlural
   * @param array $args
   * @param TranslatorInterface $translator
   * @return self new instance
   */
  public static function plural(string $singular, string $plural, bool $isPlural = false, array $args = [], TranslatorInterface $translator = null) {
    if ($translator === null) {
      $translator = static::getDefaultTranslator();
    }
    $template = new PluralTemplate($singular, $plural, $translator);
    $template->setPlural($isPlural);
    return new static($template, $args, $translator);
  }

}
