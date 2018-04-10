<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Mail;
use Sphp\Data\AbstractDataObject;
use Sphp\Data\Person;
/**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ContactMessage extends AbstractDataObject {

  /**
   * @var Person 
   */
  private $contacter;

  /**
   * @var mixed 
   */
  private $subject;

  /**
   * @var mixed 
   */
  private $message;

  /**
   * 
   * @return Person
   */
  public function getContacter() {
    return $this->contacter;
  }

  public function setContacter(Person $contacter) {
    $this->contacter = $contacter;
    return $this;
  }

  public function getSubject() {
    return $this->subject;
  }

  public function setSubject(string $subject = null) {
    $this->subject = $subject;
    return $this;
  }

  public function getMessage() {
    return $this->message;
  }

  public function setMessage(string $message = null) {
    $this->message = $message;
    return $this;
  }

  public function fromArray(array $data) {
    $args = [
        'subject' => \FILTER_SANITIZE_STRING,
        'message' => \FILTER_SANITIZE_STRING,
    ];
    $parsed = filter_var_array($data, $args, true);
    $this->setSubject($parsed['subject']);
    $this->setMessage($parsed['message']);
    if (array_key_exists('contacter', $data)) {
      $this->setContacter(new Person($data['contacter']));
    } else {
      $this->setContacter(new Person($data));
    }
  }

  public function toArray(): array {
    $raw = get_object_vars($this);
    if ($raw['contacter'] instanceof Person) {
      $raw['contacter'] = $this->contacter->toArray();
    }
    return $raw;
  }

}
