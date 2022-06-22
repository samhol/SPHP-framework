<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Views;

use Sphp\Html\Tags;
use Sphp\Html\Text\Span;

/**
 * Class Utils
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Utils {

  public static function formatPrice(int $cents, string $currency = '€'): Span {
    $euros = $cents / 100;
    $amount = number_format($euros, 2, ',', ' ');
    $out = Tags::span($amount)->addCssClass('price');
    $out->append(" <span class=\"currency\">$currency</span>");
    return $out;
  }

  public static function createCounterBadge(int $num, ?string $hiddenText = null): Span {
    $count = Tags::span($num)->addCssClass('product-count');
    $badge = Tags::span($count);
    $badge->addCssClass('product-counter badge position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger');
    if ($hiddenText !== null) {
      $info = Tags::span($hiddenText)->addCssClass('visually-hidden');
      $badge->append($info);
    }
    if ($num === 0) {
      $badge->addCssClass('hidden');
    }
    return $badge;
  }

}
