<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\PoSearch\View;

use Sphp\Html\AbstractContent;
use Sphp\Bootstrap\Components\Navigation\Pagination;
use Sphp\Apps\PoSearch\Data\RequestData;

/**
 * The PaginationView class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PaginationView extends AbstractContent {

  private RequestData $requestData;
  private int $total;

  public function __construct(RequestData $data, int $count) {
    $this->requestData = $data;
    $this->total = $count;
  }

  public function __destruct() {
    unset($this->requestData);
  }

  public function buildPageRange(): ?Pagination {
    // $total = $this->total;
    $pagination = null;
    $c = 0;
    $query = $this->requestData->toQuery();
    $sliceSize = $this->requestData->getSliceSize();

    if ($this->total > $sliceSize) {
      //var_dump($this->count, $this->requestData->getSliceSize(), $this->first, $this->requestData->getOffset());
      $pagination = new Pagination('Gettext entry search result subpages pagination');
      $pageCount = ceil($this->total / $sliceSize);
      $lastPage = $pageCount - 1;
      $pageRange = range(0, $pageCount, 1);
      print_r($pageRange);
      $currentPage = $this->requestData->getOffset();
      $radius = 3;
      $subs = range(0, $this->total, $sliceSize);
      $currKey = array_search($this->requestData->getOffset(), $subs);
      $last = count($subs) - 1;
      if ($lastPage - $currentPage < 4) {
        $fk = ($last - 9 >= 0) ? $last - 9 : 0;
      } else if ($currKey - 4 < 0) {
        $fk = 0;
        $link->addCssClass('disabled');
      } else {
        $fk = $currKey - 4;
      }
      $slice = array_slice($subs, $fk, 9, true);
      foreach ($slice as $k => $offset) {
        $query->set('page', $k);
        $link = $pagination->appendLink("?$query", (string) ($k + 1));
        if ($this->requestData->getOffset() === $offset) {
          $currentPage = $k;
          $link->setActive();
          $c += $this->requestData->getSliceSize();
        }
      } if ($currentPage > 0) {
        $query->set('page', $currentPage - 1);
        $pagination->prependLink("?$query", 'Previous');
      }
      if ($currentPage < $last) {
        $query->set('page', $currentPage + 1);
        $pagination->appendLink("?$query", 'Next');
      }
      $pagination->appendEllipsis();
      $pagination->setAlignment('justify-content-center');
    }
    return $pagination;
  }

  public function buildPagination(): ?Pagination {
    // $total = $this->total;
    $pagination = null;
    $query = $this->requestData->toQuery();
    $sliceSize = $this->requestData->getSliceSize();

    if ($this->total > $sliceSize) {
      $pagination = new Pagination('Gettext entry search result subpages pagination');
      $pageCount = ceil($this->total / $sliceSize);
      $lastPage = $pageCount - 1;
      //$pageRange = range(0, $pageCount, 1);
      //  print_r($pageRange);
      $currentPage = $this->requestData->getPage();
      $radius = 3;
      $last = $currentPage + $radius;
      $first = $currentPage - $radius;
      if ($first < 0) {
        $last = $last + (-$first);
        $first = 0;
      }
      if ($last > $lastPage) {
        $last = $lastPage;
      }
      for ($p = $first; $p <= $last; $p++) {
        $query->setParameter('page', $p);
        $link = $pagination->appendLink("?$query", (string) ($p + 1));
        if ($currentPage === $p) {
          $link->setActive();
        }
      }


      if ($first > 0) {
        if ($first > 1) {
          $pagination->prependEllipsis();
        }
        $query->setParameter('page', 0);
        $pagination->prependLink("?$query", "1");
      }
      if ($currentPage > 0) {
        $query->setParameter('page', $currentPage - 1);
        $pagination->prependLink("?$query", 'Previous');
      }
      if ($last < $lastPage) {
        if ($last + 1 < $lastPage) {
          $pagination->appendEllipsis();
        }
        $query->setParameter('page', $lastPage);
        $pagination->appendLink("?$query", (string) ($lastPage + 1));
      }
      if ($currentPage < $lastPage) {
        $query->setParameter('page', $currentPage + 1);
        $pagination->appendLink("?$query", 'Next');
      }
      $pagination->setAlignment('justify-content-center');
    }
    return $pagination;
  }

  function getHtml(): string {
    return $this->buildPagination() . '';
  }

}
