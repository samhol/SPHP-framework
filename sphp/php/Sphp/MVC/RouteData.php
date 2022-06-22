<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\MVC;

/**
 * Class RouteData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
final class RouteData {

  private array $seqParams;

  /**
   * Constructor
   * 
   * @param string $path
   * @param string $params
   */
  public function __construct(private string $path, private array $params = []) {
    //$this->path = $path;
    $this->seqParams = array_values($this->params);
  }

  public function getPath(): string {
    return $this->path;
  }

  /**
   * Returns optional params
   * 
   * @return string[]
   */
  public function getParams(): array {
    return $this->params;
  }

  public function hasNamedParam(string $name): bool {
    return array_key_exists($name, $this->params);
  }

  public function getNamedParam(string $name): ?string {
    return $this->params[$name] ?? null;
  }

  public function getParam(int $pos): ?string {
    return $this->seqParams[$pos] ?? null;
  }

}
