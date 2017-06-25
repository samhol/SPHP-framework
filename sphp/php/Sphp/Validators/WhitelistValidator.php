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

  const ILLEGAL_KEY = '_illegal_key_';

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
    parent::__construct('Array expected');
    $this->setMessageTemplate(self::ILLEGAL_KEY, 'An illegal key found');
    $this->setWhitelist($whitelist);
  }

  public function getWhitelist() {
    return $this->whitelist;
  }

  public function setWhitelist(array $whitelist) {
    $this->whitelist = $whitelist;
    return $this;
  }

  public function isValid($param): bool {
    if (!is_array($param)) {
      $this->error(self::INVALID);
      return false;
    }
    foreach ($param as $key => $item) {
      if (!in_array($key, $this->whitelist)) {
        $this->error(self::ILLEGAL_KEY);
        return false;
      }
    }
  }

}
