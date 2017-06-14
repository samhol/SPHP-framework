<?php

/**
 * Translator.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\I18n;

use Sphp\Exceptions\InvalidArgumentException;
use Sphp\I18n\Gettext\Translator;

/**
 * Implements a natural language translator
 *
 * The underlying technology used in translation is PHP's gettext extension.
 *
 * **Links:**
 *
 * * {@link http://www.gnu.org/software/gettext/manual/}
 * * {@link http://www.gnu.org/software/gettext/manual/html_node/index.html}
 * * {@link http://php.net/manual/en/book.gettext.php}
 * * {@link http://php.net/manual/en/function.setlocale.php}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Translators {

  /**
   * @var self
   */
  private static $instance;

  /**
   * @var TranslatorInterface[]
   */
  private $translators;

  /**
   * @var TranslatorInterface
   */
  private $default;

  public function __construct(TranslatorInterface $default = null) {
    if ($default === null) {
      $this->setDefault(new Translator);
    }
  }

  /**
   * 
   * @return self singelton instance
   */
  public static function instance():Translators {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

  /**
   * 
   * @return TranslatorInterface
   */
  public function getDefault(): TranslatorInterface {
    return $this->default;
  }

  /**
   * 
   * @param  TranslatorInterface $default
   * @return $this
   */
  public function setDefault(TranslatorInterface $default) {
    $this->default = $default;
    return $this;
  }

  /**
   * Stores the given instances as a named translator
   *
   * 
   * @param string $name the name specified
   * @param TranslatorInterface $translator
   */
  public function store(string $name, TranslatorInterface $translator) {
    $this->translators[$name] = $translator;
  }

  /**
   * 
   * @param  string $name
   * @return TranslatorInterface
   * @throws InvalidArgumentException
   */
  public function get(string $name = null): TranslatorInterface {
    if ($name === null) {
      return $this->getDefault();
    }
    if (!array_key_exists($name, $this->translators)) {
      throw new InvalidArgumentException;
    }

    return $this->translators[$name];
  }

  /**
   * 
   * @param  string $name
   * @return bool
   */
  public function contains(string $name): bool {
    return array_key_exists($name, $this->translators);
  }

}
