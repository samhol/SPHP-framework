<?php

/**
 * Foundation.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6;

use Sphp\Util\Strings as Strings;
use Sphp\Html\Doc as Doc;
use UnexpectedValueException;

/**
 * Factory class for Foundation components
 *
 * {@link self} component provides navigation for entire site, or for sections 
 *  of an individual page.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-18
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/button_groups.html Foundation Button groups
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Foundation {

  /**
   * 
   * @param  string $component
   * @return ContentInterface
   * @throws UnexpectedValueException
   */
  public static function get($component) {
    if (Strings::startsWith($component, ["fi", "fi-"])) {
      $obj = static::icon($component);
    } else {
      throw new UnexpectedValueException();
    }
    return $obj;
  }

  /**
   * 
   * @param  string $name
   * @param  string $tagName
   * @return ContentInterface
   * @throws UnexpectedValueException
   */
  public static function icon($name, $tagName = "i") {
    if (!Strings::startsWith($name, "fi-")) {
      $name = "fi-" . $name;
    } 
    $obj = Doc::get($tagName);
    $obj->addCssClass($name);
    return $obj;
  }

  /**
   * 
   * 
   * @param  string $name
   * @return ContentInterface
   */
  public function __invoke($name) {
    return static::get($name);
  }

}
