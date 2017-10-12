<?php

/**
 * FoundationDocsLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * Hyperlink generator pointing to online Foundation Documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FoundationDocsLinker extends AbstractLinker {

  /**
   * Constructs a new instance
   * 
   * @param string|null $defaultTarget the default target used in the generated links or `null` for none
   */
  public function __construct(string $defaultTarget = '_blank') {
    parent::__construct(new UrlGenerator('http://foundation.zurb.com/sites/docs/'), $defaultTarget);
  }

}
