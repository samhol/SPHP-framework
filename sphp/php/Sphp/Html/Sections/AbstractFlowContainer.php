<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Sections;

use Sphp\Html\ContainerTag;
use Sphp\Html\Sections\Headings\H1;
use Sphp\Html\Sections\Headings\H2;
use Sphp\Html\Sections\Headings\H3;
use Sphp\Html\Sections\Headings\H4;
use Sphp\Html\Sections\Headings\H5;
use Sphp\Html\Sections\Headings\H6;
use Sphp\Html\Navigation\A;
use Sphp\Html\Div;

/**
 * Abstract implementation of an HTML flow container
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_main.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractFlowContainer extends ContainerTag implements FlowContainer {

  public function appendParagraph($content = null): Paragraph {
    $component = new Paragraph($content);
    $this->append($component);
    return $component;
  }

  public function appendH1($content = null): H1 {
    $component = new H1();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendH2($content = null): H2 {
    $component = new H2();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendH3($content = null): H3 {
    $component = new H3();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendH4($content = null): H4 {
    $component = new H4();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendH5($content = null): H5 {
    $component = new H5();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendH6($content = null): H6 {
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

  public function appendHyperlink(string $href = null, $content = null, string $target = null): A {
    $component = new A($href, $content, $target);
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

  public function appendAside($content = null): Aside {
    $component = new Aside($content);
    $this->append($component);
    return $component;
  }

  public function appendDiv($content = null): Div {
    $component = new Div($content);
    $this->append($component);
    return $component;
  }

}
