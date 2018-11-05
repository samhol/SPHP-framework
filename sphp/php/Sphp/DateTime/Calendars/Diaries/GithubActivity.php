<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\DateTime\Calendars\Diaries;

/**
 * Description of GithubActivity
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class GithubActivity implements DiaryInterface {

  public function getDate($date): DiaryDateInterface {
    $j = new \Sphp\Stdlib\Parsers\Json();
    $dd = new DiaryDate($date);
    $log = Logs::unique($date, 'GitHub');
    $data = \Sphp\Stdlib\Networks\RemoteResource::read('https://api.github.com/repos/samhol/SPHP-framework/commits?since=2018-10-26T00:00:00Z&until=2018-10-26T23:59:59Z');
    $log->setData($data);
    $dd->insertLog($log);
    return $dd;
  }

}
