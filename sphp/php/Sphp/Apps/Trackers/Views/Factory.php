<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Views;

use Sphp\Foundation\Sites\Grids\BasicRow;
use Sphp\DateTime\DateTime;
use Sphp\DateTime\Date;
use Sphp\Html\Tags;
use Sphp\Html\Text\Span;

/**
 * Class Factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class Factory {

  public static function paintDescription(string $what): BasicRow {
    $row = new BasicRow();
    $row->appendCell(Tags::span("$what:")->addCssClass('what'))->small(3);
    return $row;
  }

  public static function buildDateText(Date $date): Span {
    return Tags::span($date->format('M j, Y'))->addCssClass('date', 'val');
  }
  public static function buildTimeText(DateTime $date): Span {
    $cont = Tags::span()->addCssClass('time', 'val');
    $cont->append(Tags::span($date->format('H:i:s '))->addCssClass('time', 'val'));
    $cont->append(Tags::span($date->format(' T'))->addCssClass('time-zone', 'val'));
    return $cont;
  }
  public static function buildDateTimeText(DateTime $date): Span {
    $cont = Tags::span()->addCssClass('datetime', 'val');
    $cont->append(self::buildDateText($date));
    $cont->append(self::buildTimeText($date));
    return $cont;
  }

  public static function paintDateTime(string $what, DateTime $date): BasicRow {
    $row = static::paintDescription($what);
    $row->appendCell(static::buildDateTimeText($date))->auto();
    return $row;
  }

  public static function paintDate(string $what, Date $date): BasicRow {
    $row = static::paintDescription($what);
    $row->appendCell(static::buildDateText($date))->auto();
    return $row;
  }

  public static function paintTotal(string $what, int $tot): BasicRow {
    $row = static::paintDescription($what);
    $row->appendCell(Tags::span($tot)->addCssClass('count', 'val'))->auto();
    return $row;
  }

  public static function paintAll(string $what, int $tot, float $share): BasicRow {
    $row = static::paintTotal($what, $tot);
    $pres = $share * 100;
    $cont = Tags::span()->addCssClass('percentage', 'val');
    $cont->append(Tags::span("$pres% ")->addCssClass('percentage'));
    $cont->append(Tags::span(' of total')->addCssClass('description'));
    $row->appendCell($cont)->auto()->addCssClass('text-right');
    return $row;
  }

}
