<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\References;

use Sphp\Html\AbstractContent;
use Sphp\Html\Navigation\A;
use DateTimeInterface;
use Sphp\DateTime\Date;
use Sphp\DateTime\DateTimes;

/**
 * Class Reference
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Reference extends AbstractContent {

  private A $link;
  private DateTimeInterface|Date $retrieved;

  public function __construct(string $href, ?string $linkText, \DateTimeInterface|string|null $retrieved = null) {
    $this->link = new A($href, $linkText . ' <i class="fa-solid fa-arrow-up-right-from-square fa-fw"></i>');
    $this->link->setRelationship('nofollow');
    $this->retrieved = DateTimes::dateTimeImmutable($retrieved);
  }

  public function getHtml(): string {
    $out = $this->link->getHtml();
    if (isset($this->retrieved)) {
      $out .= '. <wbr> Retrieved: <code>' . $this->retrieved->format('Y-m-d') . '</code>';
    }
    return $out;
  }

}
