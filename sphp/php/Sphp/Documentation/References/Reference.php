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

  private string $groupName;
  private string $href;
  private string $linkText;
  private DateTimeInterface|Date|null $retrieved = null;

  public function __construct(string $href, ?string $linkText, Date|DateTimeInterface|string|null $retrieved = null) {
    $this->href = $href;
    $this->linkText = $linkText;
    $this->groupName = ReferenceGroup::parseGroupName($href);
    if ($retrieved !== null) {
      $this->retrieved = DateTimes::dateTimeImmutable($retrieved);
    }
  }

  public function getGroup(): string {
    return $this->groupName;
  }

  public function getHref(): string {
    return $this->href;
  }

  public function getHtml(): string {
    $link = new A($this->href, '<span class="text">' . $this->linkText . '</span> <i class="fa-solid fa-arrow-up-right-from-square fa-fw"></i>');
    $link->setRelationship('nofollow');
    $link->addCssClass('d-block mx-2 ref');
    if ($this->retrieved !== null) {
      $timeTag = new \Sphp\Html\Text\Time($this->retrieved->format('F jS, Y'));
      $timeTag->setDateTime($this->retrieved, 'Y-m-d');
      $link->append('<div class="ps-4 retrieved">retrieved ' . $timeTag . '</div>');
    }
    return $link->getHtml();
  }

}
