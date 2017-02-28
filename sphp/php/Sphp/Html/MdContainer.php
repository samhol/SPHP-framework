<?php

/**
 * MdContainer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use ParsedownExtraPlugin;
use Sphp\Stdlib\Filesystem;

/**
 * Implements a Markdown container
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-09
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MdContainer extends AbstractContainer {

  /**
   * Appends a Mark Down file to the container
   * 
   * @param  string $path the path to the file
   * @return self for a fluent interface
   */
  public function appendFile($path) {
    $this->append(Filesystem::executePhpToString($path));
    return $this;
  }

  public function getHtml() {
    $text = implode("\n", $this->toArray());
    return ParsedownExtraPlugin::instance()->text($text);
  }

}
