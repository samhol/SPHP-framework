<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\AbstractComponent;
use Sphp\Html\TraversableContent;

/**
 * Implementation of an HTML head tag
 *
 * The &lt;head&gt; tag is a container for all the head elements.
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_head.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Head extends AbstractComponent implements \IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var MetaContainer
   */
  private MetaContainer $content;

  /**
   * Constructor
   *
   * @param string $title the title of the HTML document
   * @param string $charset the character set of the HTML document
   */
  public function __construct(string $title = null, string $charset = null) {
    parent::__construct('head');
    $this->content = new MetaContainer();
    if ($title !== null) {
      $this->meta()->setTitle($title);
    }
    if ($charset !== null) {
      $this->meta()->insert(MetaFactory::build()->charset($charset));
    }
  }

  /**
   * Returns the meta content container
   * 
   * @return MetaContainer
   */
  public function meta(): MetaContainer {
    return $this->content;
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

  public function getIterator(): \Traversable {
    return $this->content;
  }

}
