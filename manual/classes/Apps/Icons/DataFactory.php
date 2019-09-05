<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons;

use Sphp\Stdlib\Parsers\ParseFactory;

/**
 * Implementation of DataFactory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DataFactory {

  /**
   * 
   * @param  string $path
   * @return IconsData
   */
  public static function deviconsFromJson(string $path): IconsData {
    $raw = ParseFactory::fromFile($path);
    return static::devicons($raw);
  }

  /**
   * 
   * @param  array $raw
   * @return IconsData
   */
  public static function devicons(array $raw): IconsData {
    $data = [];
    foreach ($raw as $iconData) {
      $data[$iconData['name']] = new DevIconData($iconData);
    }
    return new IconsData($data);
  }

  /**
   * 
   * @param  string $path
   * @return IconsData
   */
  public static function fontawesomeFromYaml(string $path): IconsData {
    return static::fontawesome(ParseFactory::yaml()->fileToArray($path));
  }

  /**
   * 
   * @param  array $raw
   * @return IconsData
   */
  public static function fontawesome(array $raw): IconsData {
    $data = [];
    foreach ($raw as $name => $iconData) {
      $data[$name] = new FaIconInformation($name, $iconData);
    }
    return new IconsData($data);
  }

}
