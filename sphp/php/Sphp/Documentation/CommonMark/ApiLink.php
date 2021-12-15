<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\CommonMark;

use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use Sphp\Documentation\Linkers\ItemLinker;

/**
 * Class ApiLink
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ApiLink extends Link {

  private ItemLinker $itemLinker;

  public function __construct(ItemLinker $itemLinker) {
    $this->itemLinker = $itemLinker;
    parent::__construct($itemLinker->getUrl(), $itemLinker->getDefaultContent(), null);
  }

  public function __destruct() {
    unset($this->itemLinker);
  }

  public function getLinker(): ItemLinker {
    return $this->itemLinker;
  }

}
