<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Head\Head;

/**
 * Document class contains basic Sphp HTML tag component creation and HTML version handing
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Doc {

  /**
   * the HTML components
   *
   * @var Html[]
   */
  private $html;

  public function __construct(Html $html = null) {

  }

  public function __destruct() {
    unset($this->html);
  }

  /**
   * Returns the &lt;html&gt; component pointed by the given name
   * 
   * @param  string|null $docName the name of the managed document
   * @param  Html $template
   */
  public function insert(string $docName = null, Html $template = null) {
    if (!isset($this->html[$docName])) {
      if ($template === null) {
        $template = new Html();
      }
      $this->html[$docName] = $template;
    }
    return $this;
  }

  /**
   * Returns the root the &lt;html&gt; component pointed by the given name
   * 
   * @param  string $docName the name of the managed document
   * @return Html the instance pointed by the given name
   */
  public function html(string $docName = null): Html {
    if (!isset($this->html[$docName])) {
      static::create($docName);
    }
    return $this->html[$docName];
  }

  /**
   * Returns the &lt;body&gt; component pointed by the given name
   * 
   * @param  string $docName the name of the managed document
   * @return Head the instance pointed by the given name
   */
  public function body(string $docName = null): Body {
    if (!isset($this->html[$docName])) {
      throw new InvalidArgumentException("Document $docName is not stored");
    }
    return $this->html($docName)->body();
  }

  /**
   * Returns the &lt;head&gt; component pointed by the given name
   * 
   * @param  string $docName the name of the managed document
   * @return Head the instance pointed by the given name
   */
  public function head(string $docName = null): Head {
    if (!isset($this->html[$docName])) {
      throw new InvalidArgumentException("Document $docName is not stored");
    }
    return $this->html($docName)->head();
  }

}
