<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries\Holidays;

use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Apps\Calendars\Diaries\MutableDiary;
use stdClass;
use Sphp\Apps\Calendars\Diaries\Logs;

/**
 * The HolidayParser class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HolidayParser {

  private $year;

  public function __construct(int $year) {
    $this->year = $year;
  }

  public function parseYamlFile(string $param): MutableDiary {
    $fi = ParseFactory::fromFile($param);
    return $this->parseArray($fi);
  }

  public function parseArray(array $holidayData): MutableDiary {

    $diary = new MutableDiary();
    foreach ($holidayData['dates'] as $dateData) {
      // print_r($dateData);

      $data = (object) $dateData;
      if (isset($data->easter)) {
        $easter = $this->parseEaster($data->easter);
        $diary->merge($easter);
      }
      // print_r($data);
      if (isset($data->birthday, $data->dob)) {
        $diary->insertLog($this->birthday($data));
      } if (isset($data->varying_annual, $data->rule)) {
        $diary->insertLog($this->varyingAnnual($data));
      } if (isset($data->annual, $data->month, $data->day)) {
        $diary->insertLog($this->annual($data));
      }
    }
    return $diary;
  }

  protected function birthday(stdClass $data) {
    if (isset($data->dod)) {
      $out = Logs::holiday()->birthday($data->dob, $data->birthday, $data->dod);
    } else {
      $out = Logs::holiday()->birthday($data->dob, $data->birthday);
    }
    $this->setparams($data, $out);
    return $out;
  }

  protected function parseEaster(iterable $easterDateData): iterable {
    $easterDays = [];
    $easter = new Easter($this->year);
    foreach ($easterDateData as $value) {
      $data = (object) $value;
      if (isset($data->thursday)) {
        $date = $easter->getMaundyThursday();
        $name = $data->thursday;
      } else if (isset($data->friday)) {
        $date = $easter->getGoodFriday();
        $name = $data->friday;
      } else if (isset($data->sunday)) {
        $date = $easter->getEasterSunday();
        $name = $data->sunday;
      } else if (isset($data->monday)) {
        $date = $easter->getEasterMonday();
        $name = $data->monday;
      } else if (isset($data->ascension_day)) {
        $date = $easter->getAscensionDay();
        $name = $data->ascension_day;
      } else if (isset($data->pentecost)) {
        $date = $easter->getPentecost();
        $name = $data->pentecost;
      } else {
        throw new \Exception('Easter parsing failed: date is not regognozed as easter date');
      }
      $easterHoliday = Logs::holiday()->unique($date, $name);
      $this->setparams($data, $easterHoliday);
      $easterDays[] = $easterHoliday;
    }
    return $easterDays;
  }

  protected function setparams(stdClass $data, Holiday $h): void {
    //print_r($data);
    if (isset($data->type)) {
      if (in_array('flagday', $data->type)) {
        $h->setFlagDay('fi');
      }if (in_array('public holiday', $data->type)) {
        $h->setNationalHoliday();
      }
    }
    if (isset($data->notBefore)) {
      $h->dateRule()->notBefore($data->notBefore);
    }
  }

  protected function varyingAnnual(stdClass $data): Holiday {
    $out = Logs::holiday()->varyingAnnual($data->rule, $data->varying_annual);
    $this->setparams($data, $out);
    return $out;
  }

  protected function annual(stdClass $data): Holiday {
    $out = Logs::holiday()->annual([$data->month, $data->day], $data->annual);
    $this->setparams($data, $out);
    return $out;
  }

}
