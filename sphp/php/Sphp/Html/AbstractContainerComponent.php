<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Class provides a simple implementation of a container tag
 *
 * AbstractComponent makes it possible to create new HTML components by composition
 * of other existing HTML components.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractContainerComponent extends AbstractComponent {

  /**
   * the inner content container
   *
   * @var Container
   */
  private $content;

  /**
   * Constructor
   *
   * @param  string $tagname the name of the tag
   * @param  HtmlAttributeManager|null $attrManager the attribute manager of the component
   * @param  Container|null $contentContainer the inner content container of the component
   */
  public function __construct(string $tagname, HtmlAttributeManager $attrManager = null, Container $contentContainer = null) {
    parent::__construct($tagname, $attrManager);
    $this->setInnerContainer($contentContainer);
  }

  public function __destruct() {
    unset($this->content);
    parent::__destruct();
  }

  public function __clone() {
    $this->content = clone $this->content;
    parent::__clone();
  }

  /**
   * Sets the inner content container of the component
   *
   * @param  Container $contentContainer the inner content container of the component
   * @return $this for a fluent interface
   */
  protected function setInnerContainer(Container $contentContainer = null) {
    if (!($contentContainer instanceof Container)) {
      $this->content = new PlainContainer();
    } else {
      $this->content = $contentContainer;
    }
    return $this;
  }

  /**
   * Returns the content container or an element pointed by an optional index
   *
   * @return Container the content container
   */
  protected function getInnerContainer(): Container {
    return $this->content;
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

}
