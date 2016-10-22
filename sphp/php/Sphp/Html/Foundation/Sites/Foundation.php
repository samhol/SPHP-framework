<?php

/**
 * Foundation.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites;

use Sphp\Html\ContentInterface;
use Sphp\Core\Types\Strings;
use Sphp\Html\Document;
use UnexpectedValueException;

/**
 * Factory class for Foundation components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-18
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
  public static function icon($name, $tagName = 'i') {
    if (!Strings::startsWith($name, 'fi-')) {
      $name = 'fi-' . $name;
    } 
    $obj = Document::get($tagName);
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
