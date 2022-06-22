<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Layout;

use Sphp\Html\ContainerTag;
use Sphp\Html\Text\Headings\{
  H1,
  H2,
  H3,
  H4,
  H5,
  H6
};
use Sphp\Html\Navigation\A;
use Sphp\Html\Text\Paragraph;
use Sphp\Html\Text\Hr;

/**
 * Abstract implementation of an HTML flow container
 *
 * @method \Sphp\Html\Text\Span appendSpan(mixed $content = null) Appends a span tag
 * @method \Sphp\Html\Text\Strong appendStrong(mixed $content = null) Appends a strong tag
 * @method \Sphp\Html\Text\Small appendSmall(mixed $content = null) Appends a small tag 
 * @method \Sphp\Html\Text\I appendI(mixed $content = null) Appends a i tag
 * 
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_main.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractFlowContainer extends ContainerTag implements FlowContainer {

  public function appendParagraph(mixed $content = null): Paragraph {
    $component = new Paragraph($content);
    $this->append($component);
    return $component;
  }

  public function appendH1(mixed $content = null): H1 {
    $component = new H1();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendH2(mixed $content = null): H2 {
    $component = new H2();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendH3(mixed $content = null): H3 {
    $component = new H3();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendH4(mixed $content = null): H4 {
    $component = new H4();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendH5(mixed $content = null): H5 {
    $component = new H5();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendH6(mixed $content = null): H6 {
    $component = new H6();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendHr(): Hr {
    $component = new Hr();
    $this->append($component);
    return $component;
  }

  public function appendHyperlink(?string $href = null, mixed $content = null, ?string $target = null): A {
    $component = new A($href, $content, $target);
    $this->append($component);
    return $component;
  }

  public function appendArticle(mixed $content = null): Article {
    $component = new Article($content);
    $this->append($component);
    return $component;
  }

  public function appendSection(mixed $content = null): Section {
    $component = new Section($content);
    $this->append($component);
    return $component;
  }

  public function appendAside(mixed $content = null): Aside {
    $component = new Aside($content);
    $this->append($component);
    return $component;
  }

  public function appendDiv(mixed $content = null): Div {
    $component = new Div($content);
    $this->append($component);
    return $component;
  }

}
