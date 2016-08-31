<?php

/**
 * ApiLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Core\Util\ReflectionClassExt as ReflectionClassExt;
use Sphp\Html\Navigation\Hyperlink as Hyperlink;
use Sphp\Html\Foundation\Buttons\HyperlinkButton as HyperlinkButton;
use Sphp\Html\Foundation\Buttons\ButtonGroup as ButtonGroup;
use Sphp\Core\Types\Strings as Strings;

/**
 * Link generator pointing to an existing API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29

 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractPhpApiLinker extends AbstractLinker {

  /**
   * {@inheritdoc}
   */
  public function hyperlink($relativeUrl = null, $content = null, $title = null) {
    if (Strings::isEmpty($content)) {
      $content = $relativeUrl;
    }
    return parent::hyperlink($relativeUrl, str_replace("\\", "\\<wbr>", $content), $title);
  }

  /**
   * Return the class property linker
   *
   * @param  string|\object $class class name or object
   * @return AbstractClassLinker the class property linker
   */
  abstract public function classLinker($class);

}
