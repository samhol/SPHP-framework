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

use Sphp\Exceptions\InvalidArgumentException;

/**
 * The Country class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Country {

  public string $name;
  public string $officialName;
  public $topLevelDomains;
  public string $isoCodeAlpha2;
  public string $isoCodeAlpha3;
  public string $isoCodeNumeric;
  public bool $isIndependent;
  public $languages;
  public $languageCodes;
  public $currencyCodes;
  public $callingCodes;
  public array $capital;
  public string $region;
  public string $subregion;
  public ?float $latitude;
  public ?float $longitude;
  public $areaInKilometres;
  private array $data;

  public function __construct(array $data) {
    $this->data = $data;
    // print_r($data);
    $this->parseData($data);
  }

  protected function parseData(array $countryDataItem) {
    try {

      $this->name = $countryDataItem['name']['common'];
      $this->officialName = $countryDataItem['name']['official'];
      $this->topLevelDomains = $countryDataItem['tld'];
      $this->isoCodeAlpha2 = $countryDataItem['cca2'];
      $this->isoCodeAlpha3 = $countryDataItem['cca3'];
      $this->isoCodeNumeric = $countryDataItem['ccn3'];
      $this->languages = array_values((array) $countryDataItem['languages']);
      $this->languageCodes = array_keys((array) $countryDataItem['languages']);
      $this->currencyCodes = $countryDataItem['currencies'];
      $this->isIndependent = (bool) $countryDataItem['independent'];
      //$this->callingCodes = $countryDataItem['callingCode'];
      //$this->capital = $countryDataItem['capital'][0];
      if (count($countryDataItem['capital']) >= 1) {
        //var_dump($countryDataItem['capital']);
        $this->capital = $countryDataItem['capital'];
      }
      $this->region = $countryDataItem['region'];
      $this->subregion = $countryDataItem['subregion'];
      $this->latitude = isset($countryDataItem->latlng[0]) ? $countryDataItem->latlng[0] : null;
      $this->longitude = isset($countryDataItem->latlng[1]) ? $countryDataItem->latlng[1] : null;
      $this->areaInKilometres = $countryDataItem['area'];
    } catch (\Error $ex) {
      throw new InvalidArgumentException('Invalid countrydata provided', $ex->getCode(), $ex);
    }
  }

}
