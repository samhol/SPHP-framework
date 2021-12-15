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
 * Class URLData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class URLData implements ShareData {

  /**
   * @var string 
   */
  private $urlString;

  /**
   * @var string 
   */
  private $hash;

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
   * @var string 
   */
  private $query;

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

  /**
   * @var int 
   */
  private $httpCode;

  public function __construct(string $urlString = null) {
    if($urlString !== null) {
      $this->parse($urlString);
    } 
    settype($this->domain, 'string');
    settype($this->visits, 'int');
    settype($this->hash, 'string');
    settype($this->sheme, 'string');
  }

  public function getUrlString(): string {
    return $this->urlString;
  }

  public function getHash(): string {
    return $this->hash;
  }

  public function getSheme(): string {
    return $this->sheme;
  }

  public function getQuery(): string {
    return (string) $this->query;
  }

  public function getVisits(): int {
    return $this->visits;
  }

  public function getHttpCode(): int {
    return $this->httpCode;
  }

  public function getDomain(): ?string {
    return $this->domain;
  }

  public function getPath(): ?string {
    return $this->path;
  }

  public function getURL(): URL {
    return new URL($this->urlString);
  }

  public function countVisits(): int {
    return (int) $this->visits;
  }

  public function addVisit() {
    $this->visits++;
    return $this;
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

  public function getHttpResponseCode(): ?int {
    $out = null;
    if ($this->httpCode !== null) {
      $out = (int) $this->httpCode;
    }
    return $out;
  }

  public function getShare(): float {
    return (float) $this->share;
  }

  public function setShare(float $share) {
    $this->share = $share;
    return $this;
  }

  private function parse(string $urlString): void {
    $now = time();
    $url = new URL($urlString);
    $this->hash = md5($urlString);
    $this->sheme = $url->getScheme();
    $domain = $url->getHost();
    $this->path = $url->getPath();
    $this->query = parse_url($urlString, PHP_URL_QUERY);
    $this->lastVisit = $now;
    $this->visits = 1;

    $this->domain = preg_replace('/^(www|mail)./', '', $domain);
  }

  public static function fromCurrentPage(): URLData {
    return new static(URL::getCurrentAsString());
  }

}
