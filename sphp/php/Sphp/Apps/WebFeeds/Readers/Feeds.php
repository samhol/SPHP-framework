<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\WebFeeds\Readers;

use SimpleXMLElement;
use Sphp\Apps\WebFeeds\Exceptions\WebFeedException;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;

/**
 * Class Loader
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class Feeds {

  /**
   * Loads a geed data from a file
   * 
   * @param  string $url the path or the URL to the feed file
   * @param  string|null $name optional feed name
   * @return Feed|null
   * @throws WebFeedException
   */
  public static function load(string $url, ?string $name = null): ?Feed {
    $thrower = ErrorToExceptionThrower::getInstance(WebFeedException::class);
    $thrower->start();
    try {
      $xml = simplexml_load_file($url);
    } catch (WebFeedException $ex) {
      $thrower->stop();
      throw $ex;
    }
    $thrower->stop();
    if (!$xml instanceof SimpleXMLElement) {
      throw new WebFeedException('Cannot open feed file');
    }
    if ($xml->channel) {
      $feed = new RSS($xml, $name);
    } else if ($xml->getName() === 'feed') {
      $feed = new Atom($xml, $name);
    } else {
      throw new WebFeedException('Malformed feed file');
    }
    return $feed;
  }

}
