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

use Sphp\Html\AbstractContent;
use Sphp\Apps\WebFeeds\Readers\Feed;
use Sphp\Apps\WebFeeds\Readers\Entry;
use Sphp\Html\Lists\Ol;
use Sphp\Bootstrap\Components\Navigation\Pagination;
use Sphp\Html\Layout\Header;
use Sphp\Html\Navigation\A;

/**
 * The ChannelView class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ChannelView extends AbstractContent {

  public function buildChannelInfo(Feed $rss): Header {
    $header = new Header();
    //$rss->getTitle();
    $text = $rss->getName() . ' <wbr> <small style="display:inline-block">(<var>' . $rss->count() . '</var> items)</small>';
    //var_dump($rss->getAlternativeLink());
    $header->appendH3(new A((string) $rss->getAlternativeLink(), $text));
    // $section->append("Total items: " . $rss->count());
    if ($rss->getSelfLink() !== null) {
      $link = new A((string) $rss->getSelfLink(), '<i class="fas fa-rss"></i> Link to feed file', '_feed');
      $header->append($link);
      //  print_r($rss->getLinksByRel('self'));
    }
    return $header;
  }

  /**
   * 
   * @param  Entry[] $items
   * @return Ol
   */
  public function buildList(array $items): Ol {
    $ol = new Ol;
    $ol->setStart(array_key_first($items) + 1);
    foreach ($items as $entry) {
      $link = $entry->getAlternativeLink();
      if ($link !== null) {
        $ol->appendLink($link->getHref(), $entry->getTitle());
      } else {
        $ol->append($entry->getTitle());
      }
    }
    return $ol;
  }

  public function buildPagination(int $num, int $current = 1, string $label = 'RSS subpages pagination'): Pagination {
    $pagination = new Pagination($label);
    for ($i = 0; $i < $num; $i++) {
      $link = $pagination->appendLink("?p=$i", (string) ($i + 1));
      if ($current === $i) {
        $link->setActive();
      }
    }
    $pagination->setAlignment('justify-content-center');
    return $pagination;
  }

  public function getHtml(): string {
    
  }

}
