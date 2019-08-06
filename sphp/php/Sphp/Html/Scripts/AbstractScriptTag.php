<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Scripts;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Implements an HTML &lt;script&gt; tag having script code as its content
 *
 * **IMPORTANT:** 
 * 
 * This component contains scripting statements
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link http://www.w3schools.com/tags/tag_script.asp w3schools API
 * @link http://dev.w3.org/html5/spec/Overview.html#script W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractScriptTag extends AbstractComponent implements ScriptTag {

  /**
   * Constructor
   * 
   * @param HtmlAttributeManager $attrManager
   */
  public function __construct(HtmlAttributeManager $attrManager = null) {
    parent::__construct('script', $attrManager);
  }

  /**
   * Specifies the MIME type of the script
   *
   * @param  string $type the value of the type attribute (mime-type)
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_script_type.asp type attribute
   */
  public function setType(string $type = null) {
    $this->attributes()->setAttribute('type', $type);
    return $this;
  }

  public function setAsync(bool $async = true) {
    $this->attributes()
            ->remove('defer')
            ->setAttribute('async', $async);
    return $this;
  }

  public function isAsync(): bool {
    return $this->attributeExists('async');
  }

  public function setDefer(bool $defer = true) {
    $this->attributes()
            ->remove('async')
            ->setAttribute('defer', $defer);
    return $this;
  }

  public function isDefered(): bool {
    return $this->attributeExists('defer');
  }

}
