<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers;

use PDO;
use Sphp\Network\URL;

/**
 * 
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Controller {

  /**
   * @var Data 
   */
  private $db;

  public function __construct($servername = "mysql05.domainhotelli.fi", $username = "cvcumjox_cvcumjox", $password = "nUj&UGZb3~?!", $dbname = "cvcumjox_db") {
    $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $this->db = new Data($this->pdo);
  }

  public function run(): void {
    $outputs = [];
    $user = User::fromCookie();

    $current = time();
    $year = 31536000 + time();
    $user->setData($this->db->getUserData($user));
    if ($user !== null && $this->db->contains($user)) {
      $change = $current - $user->getLastVisit();
      $delay = 160 * 60 * 3;
      if ($change > $delay) {//60 * 60 * 24
        $this->db->addRevisit($user);
        $outputs[] = "$delay seconds gone...";
        $outputs[] = "Welcome back!";
        $outputs[] = "You last visited on " . date("m/d/y h:i:s", $user->getLastVisit());
      } else {
        //setcookie('lastVisit', $current, $year);
        //$saver->addSite($user, Sphp\Network\URL::getCurrent());
        //$this->db->addSiteRefresh($user, URL::getCurrent()->getPath());
        $outputs[] = "Delay not gone!";
        $outputs[] = "Thanks for using our site!";
      }
      $outputs[] = "$change seconds between refreshes";

      // setcookie('lastVisit', $current, $year);
    } else {
      $user = User::generate();
      // $id = $user->getId();
      //$id = $saver->insertVisitor();
      $this->db->insertVisitor($user);
      $outputs[] = "Welcome to our site!";
//Greets a first time user
    }

    $this->db->addSiteRefresh($user, URL::getCurrent()->getPath());
    setcookie('visitor_id', $user->getId(), $year);
    setcookie('lastVisit', $current, $year);
    $outputs[] = "Total visits: " . $this->db->countVisits();
    $outputs[] = "Your visits: " . $this->db->countVisits($user);
    $outputs[] = "Total clicks: " . $this->db->countRefreshes();
    $outputs[] = "Your clicks: " . $this->db->countRefreshes($user);
    //echo '<pre>';
    $this->output = $outputs;
    // print_r($outputs);
    // print_r($this->db->getUserData($user));
    // print_r($this->db->getUrlData($user));
    //  print_r($this->db->getUserData($user));
    // print_r($this->db->getUrlData());
    //print_r($_COOKIE);
    // print_r(User::fromCookie());
    // var_dump($this->db->containsUrl($user, \Sphp\Network\URL::getRootAsString()));
//$user = \Sphp\Apps\Trackers\User::generate();
    $user->updateLastVisit();
    // print_r($user);
    // print_r(User::fromCookie());
    // $view = new VisitsView($this->db);
    // echo $view->buildSiteTable();
  }

  public function ViewData() {
    $view = new VisitsView($this->db);
    echo $view->buildTotals();
    echo $view->buildSiteTable();
  }

}
