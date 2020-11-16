<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Tags;

/**
 * Class Ajax
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Ajax {

  /**
   * @var string
   */
  private $tagName;

  public function __construct(string $tagName = 'div') {
    $this->tagName = $tagName;
  }

  public function createContentLoader(string $path): Component {
    $ajax = Tags::create($this->tagName);
    $ajax->setAttribute('data-sphp-ajax-replace', $path);
    return $ajax;
  }

  public function load(string $path) {
    echo $this->createContentLoader($path);
    return $this;
  }

}
