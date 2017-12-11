<?php

/**
 * ContentCreatorTrait.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Flow;

use Sphp\Html\Flow\Headings\H1;
use Sphp\Html\Flow\Headings\H2;
use Sphp\Html\Flow\Headings\H3;
use Sphp\Html\Flow\Headings\H4;
use Sphp\Html\Flow\Headings\H5;
use Sphp\Html\Flow\Headings\H6;
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

  /**
   * Appends an HTML &lt;p&gt; object
   * 
   * @param  mixed $content optional content of appended component
   * @return Paragraph appended object
   */
  public function appendParagraph($content = null): Paragraph {
    $component = new Paragraph($content);
    $this->append($component);
    return $component;
  }

  /**
   * Appends an HTML &lt;h1&gt; object
   * 
   * @param  mixed $content optional content of appended component
   * @return H1 appended object
   */
  public function appendH1($content = null): H1 {
    $component = TagFactory::h1();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  /**
   * Appends an HTML &lt;h2&gt; object
   * 
   * @param  mixed $content optional content of appended component
   * @return H2 appended object
   */
  public function appendH2($content = null): H2 {
    $component = TagFactory::h2();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  /**
   * Appends an HTML &lt;h3&gt; object
   * 
   * @param  mixed $content optional content of appended component
   * @return H3 appended object
   */
  public function appendH3($content = null): H3 {
    $component = TagFactory::h3();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  /**
   * Appends an HTML &lt;h4&gt; object
   * 
   * @param  mixed $content optional content of appended component
   * @return H4 appended object
   */
  public function appendH4($content = null): H4 {
    $component = TagFactory::h4();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  /**
   * Appends an HTML &lt;h5&gt; object
   * 
   * @param  mixed $content optional content of appended component
   * @return H5 appended object
   */
  public function appendH5($content = null): H5 {
    $component = TagFactory::h5();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  /**
   * Appends an HTML &lt;h6&gt; object
   * 
   * @param  mixed $content optional content of appended component
   * @return H6 appended object
   */
  public function appendH6($content = null): H6 {
    $component = TagFactory::h6();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  /**
   * Appends an HTML &lt;article&gt; object
   * 
   * @param  mixed $content optional content of appended component
   * @return Article appended object
   */
  public function appendArticle($content = null): Article {
    $component = new Article($content);
    $this->append($component);
    return $component;
  }

  /**
   * Appends an HTML &lt;section&gt; object
   * 
   * @param  mixed $content optional content of appended component
   * @return Section appended object
   */
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
