<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers;

/**
 * URL string generator pointing to an online site
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ApiDocURLBuilder implements ApiUrlGenerator {

  /**
   * the URL pointing to the API documentation root
   *
   * @var string|null
   */
  private ?string $root;
  private string $apiName;

  /**
   * Constructor
   * 
   * @param string|null $root the URL pointing to the documentation root
   * @param string $name
   */
  public function __construct(?string $root, string $name) {
    $this->root = $root;
    $this->apiName = $name;
  }

  public function getApiname(): string {
    return $this->apiName;
  }

  public function getRootUrl(): ?string {
    return $this->root;
  }

  /**
   * 
   * @param  string|null $url
   * @param  string|float ... $params
   * @return string
   */
  public function createUrl(?string $url = null, ...$params): string {
    $out = $this->getRootUrl();
    if (count($params) > 0) {
      $out .= vsprintf($url, $params);
    } else {
      $out .= $url;
    }
    return $out;
  }

}
