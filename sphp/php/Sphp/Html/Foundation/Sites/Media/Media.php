<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Span;
use Sphp\Html\Component;
use Sphp\Stdlib\Strings;

/**
 * Factory for some Foundation Media objects
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class Media {

  public static function badge($content, string $color = null): Component {
    $badge = new Span($content);
    $badge->cssClasses()->protectValue('badge');
    return $badge;
  }

  public static function label($content, string $color = 'primary'): Component {
    $label = new Span($content);
    $label->cssClasses()->protectValue('label')->add($color);
    return $label;
  }

  public static function iconLabel($icon, $content, string $color = 'primary'): Component {
    $badge = new Span($content);
    $badge->cssClasses()->protectValue('label')->add($color);
    return $badge;
  }

  public static function fileTypeBadge($file): \Sphp\Html\Tag {
    $icon = \Sphp\Html\Media\Icons\Filetype::get($file); //Icons::fileType($file);
    return static::badge($icon);
  }

  /**
   * Creates a Badge object
   *
   * @param  string $what
   * @param  array $arguments 
   * @return Tag the corresponding component
   * @throws BadMethodCallException
   */
  public static function __callStatic($what, $arguments) {
    if (Strings::endsWith($what, 'Badge')) {
      $type = Strings::trimRight($what, 'Badge');
      $icon = \Sphp\Html\Media\Icons\FA::get($type);
      $badge = Media::badge($icon)->addCssClass($type);
      return $badge;
    } else if (Strings::endsWith($what, 'Label')) {
      $type = Strings::trimRight($what, 'Label');
      $icon = \Sphp\Html\Media\Icons\FA::get($type);
      $badge = Media::label($icon)->addCssClass($type);
      return $badge;
    }
  }

}
