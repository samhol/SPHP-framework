<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Views;

use Sphp\Html\AbstractContent;
use Sphp\Html\Layout\Section;
use Sphp\Html\Layout\Aside;
use Sphp\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\Tags;
use Sphp\Foundation\Sites\Media\ProgressBar;
use Sphp\Apps\Trackers\Data\ShareData;

/**
 * Class AbstractView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractShareView extends AbstractContent {

  /**
   * @var ShareData[]
   */
  private $data;

  public function __construct() {
    $this->data = [];
  }

  public function __destruct() {
    unset($this->data);
  }

  /**
   * 
   * @param  ShareData[] $data
   * @return $this
   */
  public function setData(array $data) {
    $this->data = $data;
    return $this;
  }

  /**
   * 
   * @return ShareData[]
   */
  public function getData(): array {
    return $this->data;
  }

  abstract public function getDescriptionHeadings(): string;

  public function buildHeaderRow(): BasicRow {
    $headRow = new BasicRow();
    $headRow->addCssClass('header');
    $headRow->appendCell(Tags::span('rank')->addCssClass('row-no'))->shrink();
    $headRow->appendCell(Tags::span($this->getDescriptionHeadings())->addCssClass('description'))->auto();
    $headRow->appendCell(Tags::span('share')->addCssClass('share'))->shrink();
    return $headRow;
  }

  public function buildContent(): Section {
    $section = new Section();
    $section->addCssClass('ua-share-list');
    //$section->append($this->buildHeaderRow());
    foreach ($this->getData() as $row => $userAgentData) {
      $section->append($this->buildRow($row + 1, $userAgentData));
    }
    return $section;
  }

  public function buildRow(int $rowNumber, ShareData $data): Aside {
    $aside = new Aside();
    $aside->addCssClass('data-item');
    $descRow = new BasicRow();
    $descRow->appendCell('<div class="row-no">' . $rowNumber . '.</div>')->shrink();
    $descRow->appendCell($this->buildNameField($data))->auto();
    $descRow->appendCell($this->parseShare($data))->shrink();
    $aside->append($descRow);
    $aside->append($this->buildProgressBar($data, 3));
    return $aside;
  }

  public function getHtml(): string {
    return $this->buildContent()->getHtml();
  }

  public function buildProgressBar(ShareData $data, int $round = 2): ProgressBar {
    $rounded = round($data->getShare(), $round);
    $progresBar = new ProgressBar($rounded);
    $progresBar->showProgressText(false);
    return $progresBar;
  }

  abstract public function buildNameField(ShareData $data): string;

  protected function parseShare(ShareData $data): string {
    return '<div class="share">' . round($data->getShare(), 3) . "%</div>";
  }

  protected function parseNameAndMaker(\stdClass $param): string {
    $out = $this->parseName($param);
    if ($out === null) {
      $out = 'Unknown user agent';
    }
    $maker = $this->parseStringValue($param->maker);
    if ($maker !== null) {
      $out .= ' <small>by ' . $maker . '</small>';
    }
    return $out;
  }

  protected function parseStringValue($param): ?string {
    if ($param === null || $param === '') {
      $out = null;
    } else {
      $out = (string) $param;
    }
    return $out;
  }

}
