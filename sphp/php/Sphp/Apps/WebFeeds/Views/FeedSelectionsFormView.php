<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\WebFeeds\Views;

use Sphp\Html\Forms\Form;
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Bootstrap\Components\Forms\InputGroup;
use Sphp\Apps\WebFeeds\ViewData;

/**
 * Class FeedSelectionsFormView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FeedSelectionsFormView {

  /**
   * 
   * @param  array $feeds
   * @return Select
   */
  public function buildFeedSelectionMenu(array $feeds, string $current): InputGroup {
    $select = new Select('feed');
    $select->addCssClass('form-select');
    foreach ($feeds as $groupName => $group) {
      $grooup = $select->appendOptgroup($groupName);
      foreach ($group as $feed) {
        $grooup->appendOption(md5($feed['url']), $feed['name']);
      }
    }
    $select->setInitialValue($current);
    $group = new InputGroup($select);
    $group->prependLabel('<i class="fas fa-rss fa-lg"></i>');
    return $group;
  }

  /**
   * 
   * @param  array $feeds
   * @return Select
   */
  public function buildItemCountMenu(array $counts, int $current): InputGroup {
    $select = new Select('size');
    $select->addCssClass('form-select');
    foreach ($counts as $count) {
      $select->appendOption($count, "$count results per page");
    }
    $select->setInitialValue($current);
    $select->setInitialValue($current);
    $group = new InputGroup($select);
    $group->prependLabel('<strong>Show:</strong>');
    return $group;
  }

  private function buildForm(ViewData $data): Form {
    $form = new Form('/feeds', 'get');
    $tb = new ToolBar('RSS feed selection tools');
    $tb->addCssClass('m-2');
    $formT = new Views\FeedSelectionsFormView();
    $s = $formT->buildFeedSelectionMenu($data->getRawData(), $data->getFeedId())->addCssClass('mr-1 mb-1');
    $tb->appendInputGroup($s);
    $s1 = $formT->buildItemCountMenu($data->getSliceSizes(), $this->viewData->getCurrentSliceSize())->addCssClass('mr-1 mb-1');
    $tb->appendInputGroup($s1);
    $submitter = new \Sphp\Html\Forms\Buttons\SubmitButton('<i class="fas fa-search"></i> <strong>FIND</strong>');
    $submitter->addCssClass('btn-success');
    $tb->appendButton($submitter)->addCssClass('mb-1');
    $form->append($tb);
    return $form;
  }

}
