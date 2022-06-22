<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\WebFeeds;

use Sphp\Html\Layout\Section;
use Sphp\Bootstrap\Components\Navigation\Pagination;
use Sphp\Bootstrap\Components\ToolBar;
use Sphp\Html\Layout\Div;
use Sphp\Html\Forms\Form;

/**
 * The Controller class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Controller {

  /**
   * @var ViewData
   */
  private ViewData $viewData;

  public function __construct(ViewData $data) {
    $this->viewData = $data;
  }

  public function __destruct() {
    unset($this->viewData);
  }

  public function run(): void {
    $view = new Views\ChannelView();
    $section = new Section();
    $section->addCssClass('rss-app');
    $section->append($this->buildForm());
    $section->append($view->buildChannelInfo($this->viewData->getCurrentFeed()));
    $section->append($view->buildList($this->viewData->getVisibleEntries()));
    $section->append($this->buildPagination());
    echo $section;
  }

  private function buildPagination(): ?Div {
    $numPartitions = $this->viewData->getNumPartitions();
    $size = $this->viewData->getCurrentSliceSize();
    $div = null;
    if ($numPartitions > 1) {
      $div = new Div();
      $div->appendHr();
      $pagination = new Pagination('RSS subpages pagination');
      $feedId = $this->viewData->getFeedId();
      for ($i = 0; $i < $numPartitions; $i++) {
        $link = $pagination->appendLink("?p=$i&feed=$feedId&size=$size", (string) ($i + 1));
        if ($this->viewData->getCurrentSubpage() === $i) {
          $link->setActive();
        }
      }
      $pagination->setAlignment('justify-content-center');
      $div->append($pagination);
    }
    return $div;
  }

  private function buildForm() {
    $form = new Form('/feeds', 'get');
    $tb = new ToolBar('RSS feed selection tools');
    $tb->addCssClass('m-2');
    $formT = new Views\FeedSelectionsFormView();
    $s = $formT->buildFeedSelectionMenu($this->viewData->getRawData(), $this->viewData->getFeedId())->addCssClass('me-1 mb-1');
    $tb->appendInputGroup($s);
    $s1 = $formT->buildItemCountMenu($this->viewData->getSliceSizes(), $this->viewData->getCurrentSliceSize())->addCssClass('me-1 mb-1');
    $tb->appendInputGroup($s1);
    $submitter = new \Sphp\Html\Forms\Buttons\SubmitButton('<i class="fas fa-search"></i> <strong>FIND</strong>');
    $submitter->addCssClass('btn-success');
    $tb->appendButton($submitter)->addCssClass('mb-1');
    $form->append($tb);
    return $form;
  }

  public static function fromYaml(string $param, array $sliceSizes = [10, 20, 50]): Controller {
    $data = ViewData::fromYaml($param, $sliceSizes);
    return new static($data);
  }

}
