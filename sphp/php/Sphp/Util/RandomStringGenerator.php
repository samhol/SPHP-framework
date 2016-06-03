<?php

/**
 * RandomStringGenerator.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Util;

/**
 * Class implements a random string generator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @filesource
 */
class RandomStringGenerator {

  /**
   * alphabets to use
   * 
   *  @var string 
   */
  private $alphabet;

  /**
   * the length of the alphabet string 
   * 
   *  @var int
   */
  private $alphabetLength;

  /**
   * Constructs a new instance of the {@link RandomStringGenerator} object
   * 
   * @param string $alphabet the alphabets to use
   */
  public function __construct($alphabet = '') {
    if ('' !== $alphabet) {
      $this->setAlphabet($alphabet);
    } else {
      $this->setAlphabet(
              implode(range('a', 'z'))
              . implode(range('A', 'Z'))
              . implode(range(0, 9))
      );
    }
  }

  /**
   * Sets the alphabets to use
   * 
   * @param string $alphabet the alphabets to use
   */
  public function setAlphabet($alphabet) {
    $this->alphabet = $alphabet;
    $this->alphabetLength = strlen($alphabet);
    return $this;
  }

  /**
   * Generates a new random string
   * 
   * @param int $length the length of the randon string
   * @return string a new random string
   */
  public function generate($length) {
    $token = '';
    for ($i = 0; $i < $length; $i++) {
      $randomKey = $this->getRandomInteger(0, $this->alphabetLength);
      $token .= $this->alphabet[$randomKey];
    }

    return $token;
  }

  /**
   * Generates a random integer from the given range
   * 
   * @param int $min the start of the range
   * @param int $max the end of the range
   * @return int the randon integer
   */
  protected function getRandomInteger($min, $max) {
    $range = ($max - $min);
    if ($range < 0) {
      return $min;
    }
    $log = log($range, 2);
    $bytes = (int) ($log / 8) + 1;
    $bits = (int) $log + 1;
    $filter = (int) (1 << $bits) - 1;
    do {
      $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes))) & $filter;
    } while ($rnd >= $range);
    return ($min + $rnd);
  }

}
