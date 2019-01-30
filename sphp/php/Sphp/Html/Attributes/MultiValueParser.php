<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Validators\CollectionLength;

/**
 * Description of CssClassParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MultiValueParser {

  /**
   * @var CollectionLength|null
   */
  private $length;

  /**
   * @var string
   */
  private $delimeter = "\s";

  /**
   * @var Validator|null
   */
  private $validator;

  public function __construct() {
    $this->setRange();
  }

  public function setDelimeter(string $delimeter) {
    $this->delimeter = $delimeter;
    return $this;
  }

  public function setAtomicValidator(\Sphp\Validators\Validator $validator) {
    $this->validator = $validator;
    return $this;
  }

  public function setRange(int $min = null, int $max = null) {
    if ($min !== null || $max !== null) {
      $this->length = new CollectionLength($min, $max);
    } else {
      $this->length = null;
    }
  }

  protected function validate(array $parsed): array {

    //$manipulated = array_map([$this, 'manipulateAtomicValue'], Arrays::flatten($parsed));
    if ($this->length !== null && !$this->length->isValid($parsed)) {
      throw new InvalidArgumentException('Collection of individual values is not of correct length');
    }
    foreach ($parsed as $val) {
      //echo $val;
      if (!is_scalar($val)) {
        throw new InvalidArgumentException('Non scalar atomic value found');
      }
      if (\Sphp\Stdlib\Strings::isBlank($val) || \Sphp\Stdlib\Strings::isEmpty($val)) {
        throw new InvalidArgumentException('Empty atomic value found');
      }
      if ($this->validator !== null && !$this->validator->isValid($val)) {
        throw new InvalidArgumentException($this->validator->errorsToArray()[0]);
      }
    }
    return $parsed;
  }

  /**
   * Returns an array of unique CSS class values parsed from the input
   *
   * **Important:** Parameter <var>$raw</var> restrictions and rules
   * 
   * 1. A string parameter can contain a single atomic value
   * 2. An array can be be multidimensional
   * 3. Duplicate values are ignored
   *
   * @param  mixed $raw the value(s) to parse
   * @return array separated unique atomic values in an array
   * @throws InvalidArgumentException if validation is set and the input is not valid
   */
  public function filter($raw): array {
    $arr = [];
    if (is_array($raw)) {
      $arr = Arrays::flatten($raw);
    } else if (is_null($raw) || $raw === false || $raw === '') {
      $arr = [];
    } else if (is_string($raw)) {
      $arr = $this->explode($raw);
    } else if (is_scalar($raw)) {
      $arr = [$raw];
    } else {
      throw new InvalidArgumentException('Cannot parse raw value');
    }
    return $this->validate($arr);
  }

  /**
   * 
   * @param  string $subject
   * @return array
   * @throws InvalidArgumentException
   */
  public function explode(string $subject): array {
    $trimmed = preg_replace('/[\s]+/', ' ', $subject);
    if (\Sphp\Stdlib\Strings::isBlank($trimmed) || \Sphp\Stdlib\Strings::isEmpty($trimmed)) {
      return [];
    }
    $result = preg_split('/[' . $this->delimeter . ']+/', $trimmed, -1, \PREG_SPLIT_NO_EMPTY);
    if (!$result) {
      throw new InvalidArgumentException("$subject is shit");
    }
    return array_map('trim', $result);
  }

  /**
   * 
   * @param array $array
   * @return string
   */
  public function parseArrayToString(array $array): string {
    $output = '';
    if (!empty($array)) {
      $output = implode($this->delimeter, $array);
    }
    return $output;
  }

}
