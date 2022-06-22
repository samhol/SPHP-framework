<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\SyntaxHighlighting;

use Sphp\Config\Config;

/**
 * Class Settings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Settings {

  protected Config $raw;

  public function __construct(array $settings) {
    $this->raw = new Config($settings, false);
    $this->raw['example-root'] = $settings['example-root'] ?? './manpages/examples/';
    $this->raw = new Config($settings, false);
  }

  public function resolveExamplePath(string $try): string {
    $seed = str_replace('\\', '/', $try);
    if (!str_starts_with($seed, $this->raw['example-root'])) {
      $path = "{$this->raw['example-root']}$seed";
    }
    if (!is_file($path) && !str_ends_with($path, '.php')) {
      $path = "$path.php";
    }
    return $path;
  }

}
