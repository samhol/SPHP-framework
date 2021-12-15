<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers;;

use Sphp\Html\Navigation\A;

/**
 * Defines a Hyperlink object generator pointing to an existing site 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface DocumentationLinker  {

  /**
   * Returns a hyperlink object pointing to a linked page
   *
   * @param  string|null $url optional path from the root to the resource
   * @param  string|null $content optional content of the link
   * @return A hyperlink object pointing to an API page
   */
  public function pointTo(?string $url = null, ?string $content = null): A;
}
