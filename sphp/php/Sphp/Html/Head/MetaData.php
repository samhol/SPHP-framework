<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\Content;

/**
 * Defines metadata element
 *
 * A metadata element contains machine-readable information (metadata) about the
 * document, like its title, scripts, and style sheets.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_meta.asp w3schools HTML API
 * @link    https://developer.mozilla.org/en-US/docs/Web/HTML/Element/head MDN web docs
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface MetaData extends Content {

  /**
   * Returns the hash value 
   * 
   * @return string
   */
  public function getHash(): string;
}
