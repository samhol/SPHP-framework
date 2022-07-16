<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Sphp\Stdlib\MessageManager;

/**
 * Abstract superclass for miscellaneous data validation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractValidator implements Validator {

  protected MessageManager $messages;
  private mixed $value = null;

  /**
   * Constructor
   *
   * @param string $error error message template
   */
  public function __construct(string $error = 'Invalid value') {
    $this->messages = new MessageManager();
    $this->messages->setTemplate(static::INVALID, $error);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->messages, $this->value);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->messages = clone $this->messages;
  }

  /**
   * Invoke validator as a command
   *
   * @param  mixed $value
   * @return bool
   */
  public function __invoke($value): bool {
    return $this->isValid($value);
  }

  /**
   * Returns validated value 
   * 
   * @return mixed validated value 
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * Sets the validated value
   * 
   * @param  mixed $value the validated value
   * @return $this for a fluent interface
   */
  public function setValue(mixed $value) {
    $this->messages->unsetMessages();
    $this->value = $value;
    if (is_scalar($value) || $value instanceof \Stringable) {
      $this->messages->setParameter(':value', $value);
    }
    $this->messages->setParameter(':type', gettype($value));
    return $this;
  }

  public function setError(string|int $templateId) {
    $this->messages->appendMessageFromTemplate($templateId);
  }

  public function getMessages(): MessageManager {
    return $this->messages;
  }

}
