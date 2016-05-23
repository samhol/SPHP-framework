<?php

/**
 * Phonenumber.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

/**
 * Class Phonenumber
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @Entity 
 */
class Phonenumber implements \Sphp\Objects\ScalarObjectInterface {

  /**
   *
   * @Id @Column(type="integer")
   * @GeneratedValue
   */
  private $id;
  
  /**
   * @ManyToOne(targetEntity="Product", inversedBy="features")
   * @JoinColumn(name="product_id", referencedColumnName="id")
   */
  private $phonenumber;

  public function __construct($phonenumber) {
  }

  public function __toString() {
    
  }

  public function equals($object) {
    
  }

  public function toScalar() {
    
  }

}
