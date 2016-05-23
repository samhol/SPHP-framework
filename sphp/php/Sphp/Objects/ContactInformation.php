<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Objects;

use Sphp\Util\Arrays as Arrays;

/**
 * Description of ContactInformation
 *
 * @author samih_000
 */
class ContactInformation extends AbstractArrayableObject {

  use ToArrayTrait;

  /**
   *
   * @var Address
   */
  private $address;

  /**
   * Email
   * 
   * @var string|null
   */
  private $email;

  /**
   * Phone number field name
   * 
   * @var string|null
   */
  private $phonenumber;

  /**
   * 
   * @return Address|null
   */
  public function getAddress() {
    return $this->address;
  }

  /**
   * Returns the email address
   *
   * @return string the email address
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Returns the phonenumber
   *
   * @return string the phonenumber
   */
  public function getPhonenumber() {
    return $this->phonenumber;
  }

  /**
   * Sets the address fields of the user from the {@link Address} object
   *
   * @param  Address $address the inserted address data
   * @return self for PHP Method Chaining
   */
  public function setAddress(Address $address) {
    $this->address = $address;
    return $this;
  }

  /**
   * Sets the email address
   *
   * @param  null|string $email the email address
   * @return self for PHP Method Chaining
   */
  public function setEmail($email) {
    $this->email = $email;
    return $this;
  }

  /**
   * Sets the phonenumber
   *
   * @param  null|string $phonenumber the phonenumber
   * @return self for PHP Method Chaining
   */
  public function setPhonenumber($phonenumber) {
    $this->phonenumber = $phonenumber;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    
  }

  /**
   * {@inheritdoc}
   */
  public function fromArray(array $data = []) {
    $this->setAddress(new Address($data))
            ->setEmail(Arrays::getValue($data, "email"))
            ->setPhonenumber(Arrays::getValue($data, "phonenumber"));
    return $this;
  }

}
