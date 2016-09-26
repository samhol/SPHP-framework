<?php

/**
 * AddressValidator.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

use Sphp\items\Address as Address;

/**
 * Class validates a given address.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AddressValidator extends AbstractObjectValidator {

  /**
   * Constructs a new {@link self} validator
   */
  public function __construct() {
    parent::__construct();
    $this->set(Address::STREETADDRESS, new StringLengthValidator(2, 50))
            ->set(Address::ZIPCODE, new PatternValidator())
            ->set(Address::CITY, new RequiredValueValidator());
  }

}
