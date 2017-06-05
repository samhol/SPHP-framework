<?php

/**
 * HyperlinkButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\ComponentInterface;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Forms\Buttons\Submitter;

/**
 * Implements an HTML &lt;button&gt; tag as a Foundation Button
 * 
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Button {

  public static function create(ComponentInterface $component) {
    return new ButtonAdapter($component);
  }

  /**
   * 
   * @param type $href
   * @param type $content
   * @param type $target
   * @return type
   */
  public static function hyperlink($href = null, $content = null, $target = null) {
    return static::create(new Hyperlink($href, $content, $target));
  }
  /**
   * 
   * @param type $content
   * @param type $name
   * @param type $value
   * @return type
   */
  public static function submitter($content = null, $name = null, $value = null) {
    return static::create(new Submitter($content, $name, $value));
  }

}
