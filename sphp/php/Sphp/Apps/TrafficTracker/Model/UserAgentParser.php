<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\TrafficTracker\Model;

use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\Filesystem;
use MatthiasMullie\Scrapbook\Psr16\SimpleCache;
use MatthiasMullie\Scrapbook\Adapters\Flysystem;
use Monolog\Logger;
use BrowscapPHP\Browscap;
use Sphp\Stdlib\Strings;
use Sphp\Network\Utils;
use Sphp\Apps\TrafficTracker\Exceptions\TrafficTrackerException;

/**
 * Class UserAgentParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class UserAgentParser {

  /**
   * @var UserAgentParser
   */
  private static $instance = [];
  private Browscap $browsers;

  public function __construct(string $path) {
    try {
      $fileCache = new LocalFilesystemAdapter($path);
      $filesystem = new Filesystem($fileCache);
      $cache = new SimpleCache(new Flysystem($filesystem));
      $logger = new Logger('name');
      $this->browsers = new Browscap($cache, $logger);
    } catch (\Throwable $ex) {
      throw new TrafficTrackerException("$path", 0, $ex);
    }
  }

  public function __destruct() {
    unset($this->browsers);
  }

  public function getBrowscapData(string $browserString): \stdClass {
    $data = $this->browsers->getBrowser($browserString);
    $data->raw = $browserString;
    if ($data->browser === 'Default Browser') {
      $this->reParseDefaultBrowser($data);
    } else if (Strings::match($data->raw, '/(Nutch-)[\d]*(.[\d]*)*$/')) {
      $this->parseNutch($data);
    } else if (Strings::match($data->raw, '/curl\/[\d]*(.[\d]*)*$/')) {
      $this->parseCurl($data);
    } else if ($data->browser === 'Python') {
      $this->parsePython($data);
    } else if ($data->browser === 'python-requests') {
      $this->parsePythonRequests($data);
    }
    return $data;
  }

  public function current(): ?UserAgent {
    $string = Utils::getHttpUserAgent();
    $out = null;
    if ($string !== null) {
      $out = $this->fromRawString($string);
    }
    return $out;
  }

  private function fromData(\stdClass $data): UserAgent {
    $ua = new UserAgent();
    $ua->setRaw($data->raw)
            ->setName($data->browser)
            ->setMaker($data->browser_maker)
            ->setCrawler($data->crawler)
            ->setVersion($data->version)
            ->setIsMobileDevice($data->ismobiledevice)
            ->setMajorVersion($data->majorver)
            ->setMinorVersion($data->minorver);
    return $ua;
  }

  public function fromRawString(string $raw): UserAgent {
    $data = $this->getBrowscapData($raw);
    return $this->fromData($data);
  }

  protected function reParseDefaultBrowser(\stdClass $data): void {
    if ($data->raw === 'Mozilla/5.0 (compatible; Sitemap Generator Crawler; +https://github.com/knyzorg/Sitemap-Generator-Crawler)') {
      //echo "geagea";
      $data->browser_maker = 'knyzorg';
      $data->crawler = true;
      $data->browser = 'Sitemap-Generator-Crawler';
      $data->browser_type = 'Bot/Crawler';
    } else if ($data->raw === 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.1) Gecko/2008070208') {
      $data->browser = 'Netscape Navigator';
      $data->browser_maker = 'Netscape';
      $data->majorver = '5';
      $data->crawler = false;
      $data->browser_type = 'Browser';
    } else if ($data->raw === 'Talous Agentti') {
      $data->browser = 'Talous Agentti Crawler';
      $data->browser_maker = 'Talous Agentti';
      $data->crawler = true;
      $data->browser_type = 'Bot/Crawler';
    } else if ($data->raw === 'Internet-structure-research-project-bot') {
      $data->browser_maker = 'Unknown';
      $data->browser = 'Internet-structure-research-project-bot';
      $data->crawler = true;
      $data->browser_type = 'Bot/Crawler';
    } else if ($data->raw === 'Sidetrade indexer bot') {
      $data->browser_maker = 'Sidetrade';
      $data->browser = 'Sidetrade indexer bot';
      $data->crawler = true;
      $data->browser_type = 'Bot/Crawler';
    } else if ($data->raw === 'Mozilla/5.0 (compatible; VelenPublicWebCrawler/1.0; +https://velen.io)') {
      $data->browser_maker = 'https://velen.io';
      $data->browser = 'VelenPublicWebCrawler';
      $data->version = '1';
      $data->majorver = '1';
      $data->crawler = true;
      $data->browser_type = 'Bot/Crawler';
    }
  }

  protected function parseNutch(\stdClass $data): void {
    $data->browser_maker = 'Apache';
    $arr = [];
    preg_match('/[\d]{1,}(.[\d]*)*$/', $data->raw, $arr);
    $this->parseVersion($arr[0], $data);
  }

  protected function parseCurl(\stdClass $data): void {
    $data->browser_maker = 'https://curl.haxx.se/';
    // $data->browser = 'cURL';
    $arr = [];
    preg_match('/[\d]{1,}(.[\d]*)*$/', $data->raw, $arr);
    $this->parseVersion($arr[0], $data);
  }

  protected function parsePython(\stdClass $data): void {
    $data->browser_maker = 'AIOHTTP';
    // $data->browser = 'cURL';
    $arr = [];
    preg_match('/[\d]{1,}(.[\d]*)*$/', $data->raw, $arr);
    $this->parseVersion($arr[0], $data);
  }

  protected function parsePythonRequests(\stdClass $data): void {
    $arr = [];
    preg_match('/[\d]{1,}(.[\d]*)*$/', $data->raw, $arr);
    $this->parseVersion($arr[0], $data);
  }

  protected function parseVersion(string $rawVersion, \stdClass $data): void {
    $parts = explode('.', $rawVersion, 2);
    $data->version = $rawVersion;
    $data->majorver = $parts[0];
    $data->minorver = $parts[1];
  }

  public static function instance(string $path = './vendor/browscap/browscap-php/resources'): UserAgentParser {
    if (!array_key_exists($path, self::$instance)) {
      self::$instance[$path] = new self($path);
    }
    return self::$instance[$path];
  }

}
