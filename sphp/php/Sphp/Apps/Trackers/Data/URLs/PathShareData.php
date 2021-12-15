<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Data\URLs;

use Sphp\Apps\Trackers\Data\ShareData;
use Sphp\DateTime\ImmutableDateTime;
use Sphp\Network\URL;

/**
 * Class PathShareData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PathShareData implements ShareData {

  /**
   * @var string 
   */
  private $sheme;

  /**
   * @var string 
   */
  private $domain;

  /**
   * @var string 
   */
  private $path;

  /**
   * @var int 
   */
  private $visits = 0;

  /**
   * @var float 
   */
  private $share = 0;

  /**
   * @var int 
   */
  private $lastVisit;

  public function __construct() {
    settype($this->visits, 'int');
    settype($this->share, 'float');
  }

  public function getURL(): URL {
    $url = new URL();
    $url->setPart(URL::SCHEME, $this->sheme);
    $url->setPart(URL::HOST, $this->domain);
    $url->setPart(URL::PATH, $this->path);
    return $url;
  }

  public function getSheme(): string {
    return $this->sheme;
  }

  public function getVisits(): int {
    return $this->visits;
  }

  public function getDomain(): ?string {
    return $this->domain;
  }

  public function getPath(): ?string {
    return $this->path;
  }

  public function countVisits(): int {
    return (int) $this->visits;
  }

  public function getLastVisitAsTimestamp(): int {
    $out = $this->lastVisit;
    if ($out === null) {
      $out = time();
    }
    return $out;
  }

  public function getLastVisit(): ?ImmutableDateTime {
    $out = null;
    if ($this->lastVisit !== null) {
      $out = ImmutableDateTime::from((int) $this->lastVisit)->useCurrentTimezone();
    }
    return $out;
  }

  public function getShare(): float {
    return $this->share;
  }

}
