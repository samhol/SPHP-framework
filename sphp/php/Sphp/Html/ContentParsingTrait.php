<?php

/**
 * ContentParsingTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Core\Util\FileUtils;
use ParsedownExtraPlugin;

/**
 * Trait implements functionality of the {@link ContentParserInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-06
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ContentParsingTrait {

  /**
   * Appends a raw file to the container
   * 
   * @param  string $path
   * @return self for PHP Method Chaining
   */
  public function appendRawFile($path) {
    $this->append(FileUtils::fileToString($path));
    return $this;
  }

  /**
   * Appends an executed PHP file to the container
   * 
   * @param  string $path path to the PHP file
   * @return self for PHP Method Chaining
   */
  public function appendPhpFile($path) {
    $this->append(FileUtils::executePhpToString($path));
    return $this;
  }

  /**
   * Appends a parsed Mark Down string to the container
   * 
   * @param  string $md
   * @return self for PHP Method Chaining
   */
  public function appendMd($md) {
    $p = new ParsedownExtraPlugin();
    $this->append($p->text($md));
    return $this;
  }

  /**
   * Appends a parsed Mark Down file to the container
   * 
   * @param  string $path
   * @return self for PHP Method Chaining
   */
  public function appendMdFile($path) {
    $this->appendMd(FileUtils::executePhpToString($path));
    return $this;
  }

}
