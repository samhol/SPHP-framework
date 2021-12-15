<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data\Geographical;

use IteratorAggregate;
use Traversable;
use Countable;
use Sphp\Stdlib\Arrays;
use Sphp\Stdlib\Parsers\ParseFactory;

/**
 * The CountyDataCollection class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Countries implements IteratorAggregate, Countable {

  private static array $continents = array(
      'AF' => 'Africa',
      'AN' => 'Antarctic',
      'AS' => 'Asia',
      'EU' => 'Europe',
      'OC' => 'Oceania',
      'AM' => 'Americas',
  );

  /**
   * @var Country[]
   */
  private array $countries;

  public function __construct(array $data) {
    if ($data === null) {
      $this->countries = [];
      foreach (self::$allCountries as $value) {
        $this->append(new CountryData($value));
      }
    } else {
      $this->countries = $data;
    }
  }

  public function __destruct() {
    unset($this->countries);
  }

  public function append(Country $data) {
    $this->countries [] = $data;
    return $this;
  }

  public static function getContinentCode(string $continent): ?string {
    $code = array_search($continent, self::$continents);
    if ($code === false) {
      $code = null;
    }
    return $code;
  }

  public static function getContinentName(string $code): ?string {
    return array_key_exists($code, self::$continents) ? self::$continents[$code] : null;
  }

  public static function getContinentNames(): array {
    return self::$continents;
  }

  /**
   * 
   * @return array<string, string>
   */
  public function getExistingContinentNames(): array {
    $continentNames = [];
    foreach ($this->countries as $country) {
      if (!array_key_exists($country->getContinentCode(), $continentNames)) {
        $continentNames[$country->getContinentCode()] = $country->getContinentName();
      }
    }
    return $continentNames;
  }

  public function filterBy(string $param, string $value): Countries {
    $validator = function (Country $country)use ($param, $region): bool {
      return $country->$param === $region;
    };
    $filtered = array_filter($this->countries, $validator);
    return new static($filtered);
  }

  public function filterByRegion(string $region): Countries {
    $validator = function (Country $country)use ($region): bool {
      return $country->region === $region;
    };
    $filtered = array_filter($this->countries, $validator);
    return new static($filtered);
  }

  public function sortByRegion(): Countries {
    $copy = Arrays::copy($this->countries);
    $cmp = function (Country  $a, Country  $b): int {
      return $a->region <=> $b->region;
    };
    uasort($copy, $cmp);
    return new static($copy);
  }

  public function sortByCommonName(): Countries {
    $copy = Arrays::copy($this->countries);
    $cmp = function (Country  $a, Country  $b): int {
      return $a->name <=> $b->name;
    };
    uasort($copy, $cmp);
    return new static($copy);
  }

  public function getIterator(): Traversable {
    yield from ($this->countries);
  }

  public function count(): int {
    return count($this->countries);
  }

  /**
   * 
   * @return iterable<Country>
   */
  public static function all(): Countries { 
    $raw = ParseFactory::json()->fileToArray(__DIR__.'/../../../../../countries-app/data/countries.json');
    // print_r($raw);
    $c = [];
    foreach ($raw as $countryData) {
      $c[] = new Country($countryData); 
    }
    return new Countries($c);
  }

}
