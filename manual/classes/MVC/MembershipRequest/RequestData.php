<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC\MembershipRequest;

use Sphp\Data\AbstractDataObject;

/**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class RequestData extends AbstractDataObject {

  public function getFname(): ?string {
    return $this->fname;
  }

  public function getLname(): ?string {
    return $this->lname;
  }

  public function getPhone(): ?string {
    return $this->phone;
  }

  public function getEmail(): ?string {
    return $this->email;
  }

  public function getStreet(): ?string {
    return $this->street;
  }

  public function getZipcode(): ?string {
    return $this->zipcode;
  }

  public function getCity(): ?string {
    return $this->city;
  }

  public function getInformation(): ?string {
    return $this->information;
  }

  /**
   * Returns
   * 
   * @return string|null
   */
  public function getDob(): ?string {
    return $this->dob;
  }

  /**
   * 
   * @return DateTime|null
   */
  public function getDateOfBirth(): ?\DateTime {
    if (is_string($this->dob)) {
      $date = str_replace(['/', '.', ' '], '-', $this->dob);
      $dob = \DateTime::createFromFormat('j-n-Y', $date);
      if ($dob === false) {
        $dob = null;
      }
      return $dob;
    }
    return null;
  }

  /**
   * 
   * @return string|null
   */
  public function getAdditionalInformation(): ?string {
    return $this->information;
  }

  public function toArray(): array {
    return get_object_vars($this);
  }

  public function fromArray(array $raw) {
    $args = [
        'name' => FILTER_SANITIZE_STRING,
        'email' => FILTER_SANITIZE_STRING,
        'phone' => FILTER_SANITIZE_STRING,
        'heading' => FILTER_SANITIZE_STRING,
        'message' => FILTER_SANITIZE_STRING,
    ];
    $data = filter_var_array($raw, $args);
    $this->setInitialData($data);
    foreach ($data as $k => $v) {
      $this->{$k} = $v;
    }
  }

}
