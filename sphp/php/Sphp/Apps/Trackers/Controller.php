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
use Sphp\Stdlib\Random\UUID;

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

  /**
   * @var $user 
   */
  private $currentUser;

  public function __construct($servername = "mysql05.domainhotelli.fi", $username = "cvcumjox_cvcumjox", $password = "nUj&UGZb3~?!", $dbname = "cvcumjox_db") {
    // $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $this->db = new Data(new PDO("mysql:host=$servername;dbname=$dbname", $username, $password));
  }

  public function __destruct() {
    unset($this->db, $this->currentUser);
  }

  public function updateUserFromBatabase(User $user) {
    if ($this->db->contains($user)) {
      $data = $this->db->getUserData($user);
      $this->output['db-data'] = $data;
      $this->output['db-start-datetime'] = (new \DateTimeImmutable($data['firstVisit']))->format('Y-m-d H:i:s T');
      $user->setFirstVisit(new \DateTimeImmutable($data['firstVisit']));
      $user->setVisits($data['visits']);
      //$user->updateLastVisit(new \DateTimeImmutable($data['lastVisit']));
    }
  }

  private function updateCurrentUser(): User {
    $user = null;
    if (isset($_COOKIE['visitor_id'])) {
      $visitor_id = $_COOKIE['visitor_id'];
      $user = new User($visitor_id);
      $this->output['basic-user-from-cookie-generated'] = $user->getUID();
    } else {

      $token = UUID::v5(UUID::v4(), 'tracker');
      $user = new User($token);
      $this->output['basic-user-from-UUID-generated'] = $user->getUID();
    }
    if (!$this->db->contains($user)) {
      $this->db->insertVisitor($user);
      $this->output['new-user-added'] = 'user  inserted ' . $user->getUID();
    } else {
      $this->db->addRevisit($user);
      $this->output['user-revisit-added'] = 'user  revisited ' . $user->getUID();
    }
    $this->updateUserFromBatabase($user);
    $this->currentUser = $user;
    return $user;
  }

  private function writeCookieForCurrentUser() {
    $this->output['users-last-visit'] = $this->getCurrentUser()->getLastVisit()->format('Y-m-d H:i:s T');
    $yearFromLastVisit = $this->getCurrentUser()->getLastVisit()->add(new \DateInterval('P1Y'));
    $this->output['cookie-expires'] = $yearFromLastVisit->format('Y-m-d H:i:s T');
    setcookie('visitor_id', $this->getCurrentUser()->getUID(), $yearFromLastVisit->getTimestamp());
    $this->output['visitor_id'] = $this->getCurrentUser()->getUID();
  }

  public function getCurrentUser(): User {
    return $this->currentUser;
  }

  public function run(): void {
    $this->output = [];
    $this->updateCurrentUser();
    /* $user = User::fromCookie();
      $currentTime = new \DateTimeImmutable();
      $this->output['current-time'] = $currentTime->format('Y-m-d H:i:s T');
      $yearFromNow = $currentTime->add(new \DateInterval('P1Y'));
      $this->output['year-from-now'] = $yearFromNow->format('Y-m-d H:i:s T');
      if ($user === null) {
      $user = User::generate();
      $this->output['user-generated'] = 'user generated ' . $user->getUID();
      }
      if (!$this->db->contains($user)) {
      $this->db->insertVisitor($user);
      $this->output['new-user-added'] = 'user  inserted ' . $user->getUID();
      } else {
      $this->db->addRevisit($user);
      $this->output['user-revisit-added'] = 'user  revisited ' . $user->getUID();
      }
      $this->updateUserFromBatabase($user);
      $this->currentUser = $user; */
    $this->db->addSiteRefresh($this->getCurrentUser(), URL::getCurrent()->getPath());
    $this->db->getUserDataController($this->getCurrentUser())->storeIp();
    $this->db->getUserDataController($this->getCurrentUser())->storeUserAgent();
    $this->output['addSiteRefresh'] = 'users:(' . $this->getCurrentUser()->getUID() . ') visit to this site refreshed';
    $this->writeCookieForCurrentUser();
  }

  public function viewData() {
    $view = new VisitsView($this->db);
    echo $view->buildTotals();
    echo $view->buildSiteTable()->addCssClass('site-table');
    $browsers = new BrowserDataViewer($this->db->getStatisticsFor(Data::USER_AGENT));
    $browserDataController = new UserAgentDataController($this->db->gettPdo());
    var_dump($browserDataController->containsUserAgent($this->currentUser->getUserAgent()));
    var_dump($browserDataController->storeUserAgent($this->currentUser->getUserAgent()));
    echo $browsers->run();
    echo '<pre>';
    print_r($this->output);
   // print_r($this->currentUser);
   // print_r($this->db->getStatisticsFor(Data::USER_AGENT));
    //print_r($this->db->getUserData(User::fromCookie()));
    echo '</pre>';
  }

  private static $controller;

  public static function instance(): Controller {
    if (self:: $controller === null) {
      self:: $controller = new Controller('localhost', 'int48291_statistics', 'nO,pAS[4=tVv', 'int48291_statistics');
    }
    return self:: $controller;
  }

}
