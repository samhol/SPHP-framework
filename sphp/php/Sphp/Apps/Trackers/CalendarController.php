<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers;

use Sphp\Apps\Trackers\Data\Users\Users;
use Sphp\Apps\Calendars\MonthView;
use Sphp\Apps\Trackers\Views\Date\SimpleDateDataView;
use Sphp\Apps\Trackers\Views\Date\DateDataDetailsView;
use Sphp\Apps\Trackers\Views\Date\MonthSelector;
use Sphp\DateTime\ImmutableDate;
use ATC\Views\NaviViews;
use Sphp\Foundation\Sites\Navigation\BreadCrumbs;

/**
 * Class CalendarController
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CalendarController {

  /**
   * @var Users
   */
  private $db;

  /**
   * @var int
   */
  private $year, $month;

  /**
   * @var array
   */
  private $domain;

  public function __construct(Users $db) {
    $this->db = $db;
    $this->parseData();
  }

  public function __destruct() {
    unset($this->db);
  }

  private function parseData(): void {
    //print_r($_GET);
    //print_r(Date::mkDate(2,3,2020));
    if (filter_has_var(INPUT_GET, 'year')) {
      $this->year = filter_input(INPUT_GET, 'year', FILTER_VALIDATE_INT);
    }
    if (filter_has_var(INPUT_GET, 'month')) {
      $this->month = filter_input(INPUT_GET, 'month', FILTER_VALIDATE_INT);
    }
    if (filter_has_var(INPUT_GET, 'domain')) {
      $this->domain = filter_input(INPUT_GET, 'domain', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
    }
    if (!is_int($this->year)) {
      $this->year = (int) date('Y');
    }
    if (!is_int($this->month)) {
      $this->month = (int) date('m');
    }
    if (!is_array($this->domain)) {
      //echo 'etbrhbearhg';
      $this->domain = $this->db->getDomains();
    }
  }

  public function buildDateDetails(): void {
    if (filter_has_var(INPUT_GET, 'date')) {
      $dateString = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_STRING);
      $date = ImmutableDate::from($dateString);
      if (!filter_has_var(INPUT_GET, 'all_domains')) {
        $domains = filter_input(INPUT_GET, 'domain', FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
        //var_dump($domains);
        if ($domains === null) {
          $domains = [];
        }
        $data = $this->db->getDateTrafficData($date, $domains);
      } else {
        $data = $this->db->getDateTrafficData($date, $this->domain);
      }
      $view = new DateDataDetailsView($data);
      echo $view;
    } else {
      echo '<h3>No date given</h3>';
    }
  }

  protected function buildBreadGrumbs(): BreadCrumbs {
    $bc = NaviViews::fromYamlFile('./linkit/breadcrumbs.yml');
    return $bc->build();
  }

  public function run(): string {
    $date = ImmutableDate::from($this->year . '-' . $this->month . '-1');
    $cal = new MonthView($this->year, $this->month);
    foreach ($cal as $dayView) {
      $dateData = $this->db->getDateTrafficData($dayView->getDate(), $this->domain);
      $cont = new SimpleDateDataView($dateData);
      $dayView->setContent($cont);
      //$dayView->setAttribute('data-domains', $this->domain);
    }
    //print_r($this->db->getDomains());
    //print_r($this->db->getYears());
    // print_r($this->db->getFirstDate());
    $bc = $this->buildBreadGrumbs();
    $selector = new MonthSelector($this->db->getDomains());
    $selector->setCurrentMonth($this->month, $this->year);
    $selector->setCurrentDomain($this->domain);
    $selector->setDomains($this->db->getDomains());
    $h1 = new \Sphp\Html\Sections\Headings\H1('User statistics for <small>' . $date->format('F Y') . '</small>');
    // $script = new \Sphp\Html\Scripts\ScriptSrc('/app/stats-app/javascripts/ajax.js');
    return $h1 . $bc . $selector . $cal; // . $script;
  }

}
