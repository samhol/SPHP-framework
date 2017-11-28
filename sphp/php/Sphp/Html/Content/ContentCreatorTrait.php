<?php

/**
 * ContentCreatorTrait.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Content;

use Sphp\Html\Headings\H1;
use Sphp\Html\Headings\H2;
use Sphp\Html\TagFactory;

/**
 * Description of ContentCreatorTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ContentCreatorTrait {

  abstract protected function append($content);

  public function appendParagraph($content = null): Paragraph {
    $component = new Paragraph($content);
    $this->append($component);
    return $component;
  }

  public function appendH1($content = null): H1 {
    $component = TagFactory::h1();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendH2($content = null): H2 {
    $component = TagFactory::h2();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendArticle($content = null): Article {
    $component = new Article($content);
    $this->append($component);
    return $component;
  }

  public function appendSection($content = null): Section {
    $component = new Section($content);
    $this->append($component);
    return $component;
  }
  /**
   * Returns the heading components tag object
   *
   * @return HeadingInterface the body tag object
   */
  public function headings() {
    return $this->getComponentsByObjectType(HeadingInterface::class);
  }

  /**
   * Returns the paragraphs in this section
   *
   * @return Paragraph the body tag object
   */
  public function paragraphs() {
    return $this->getComponentsByObjectType(Paragraph::class);
  }

}
