<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n;

use Sphp\Exceptions\InvalidArgumentException;
use Sphp\I18n\Gettext\Translator;

/**
 * Implements a natural language translator library
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Translators {

  /**
   * @var Translators
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

  /**
   * Constructor
   * 
   * @param TranslatorInterface $default
   */
  public function __construct(TranslatorInterface $default = null) {
    if($default === null) {
      $default = new Translator();
    }
    $this->setDefault($default);
  }

  /**
   * Returns a singleton instance of the translator library
   * 
   * @return self singleton instance of the translator library
   */
  public static function instance(): Translators {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

  /**
   * Returns the default translator instance
   * 
   * @return TranslatorInterface the default translator instance
   */
  public function getDefault(): TranslatorInterface {
    return $this->default;
  }

  /**
   * Sets the default translator instance
   * 
   * @param  TranslatorInterface $default the default translator instance
   * @return $this for a fluent interface
   */
  public function setDefault(TranslatorInterface $default) {
    $this->default = $default;
    return $this;
  }

  /**
   * Stores the translator with given name to the library
   *
   * @param  string $name the name specified
   * @param  TranslatorInterface $translator the translator to store
   * @return $this for a fluent interface
   */
  public function store(string $name, TranslatorInterface $translator) {
    $this->translators[$name] = $translator;
    return $this;
  }

  /**
   * Returns the named translator instance from library
   * 
   * **NOTE:** 
   * @param  string|null $name the name of the translator
   * @return TranslatorInterface stored instance
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
   * Checks whether a name exists
   * 
   * @param  string $name the name to search
   * @return bool true if a translator name exists, false otherwise
   */
  public function contains(string $name): bool {
    return array_key_exists($name, $this->translators);
  }

}
