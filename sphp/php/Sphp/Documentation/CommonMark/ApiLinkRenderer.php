<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\CommonMark;

use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\HtmlElement;

/**
 * Description of InlineApiLinkRenderer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ApiLinkRenderer implements NodeRendererInterface {

  public function render(Node $inline, ChildNodeRendererInterface $childRenderer) {
    if (!$inline instanceof ApiLink) {
      throw new \InvalidArgumentException('Incompatible inline type: ' . get_class($inline));
    }
    return (string) $inline->getLinker();
  }

}
