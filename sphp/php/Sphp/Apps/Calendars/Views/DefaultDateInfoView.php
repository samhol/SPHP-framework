<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views;

use Sphp\Html\AbstractContent;
use Sphp\Apps\Calendars\Diaries\DiaryDateInterface;
use Sphp\Html\Layout\Section;

/**
 * The DefaultDateInfoView class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DefaultDateInfoView extends AbstractContent {

  /**
   * @var DiaryDateInterface
   */
  private $date;

  public function __construct(DiaryDateInterface $date) {
    $this->date = $date;
  }

  public function __destruct() {
    unset($this->date);
  }

  public function build(): Section {
    $content = new Section();
    $content->addCssClass('date-info');
    return $content;
  }

  public function getHtml(): string {
    return $this->build()->getHtml();
  }

}
