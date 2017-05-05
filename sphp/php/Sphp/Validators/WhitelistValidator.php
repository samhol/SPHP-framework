<?php

/**
 * WhitelistValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

/**
 * Description of VhitelistValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class WhitelistValidator extends AbstractValidator {

  /**
   *
   * @var array
   */
  private $whitelist = [];

  /**
   * Constructs a new validator
   * 
   * @param array $whitelist
   */
  public function __construct(array $whitelist = []) {
    parent::__construct();
    $this->setWhitelist($whitelist);
  }

  public function getWhitelist() {
    return $this->whitelist;
  }

  public function setWhitelist(array $whitelist) {
    $this->whitelist = $whitelist;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isValid($param) {
    if (!is_array($param)) {
      $this->addErrorMessage('Array expected');
      return false;
    }
    foreach ($param as $key => $item) {
      if (!in_array($key, $this->whitelist)) {
        $this->addErrorMessage("An illegal key found");
        return false;
      }
    }
  }

}
