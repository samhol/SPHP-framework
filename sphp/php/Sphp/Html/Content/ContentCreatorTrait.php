<?php

/**
 * ContentCreatorTrait.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Content;

use Sphp\Html\Headings\H1;
use Sphp\Html\Headings\H2;
use Sphp\Html\Factory;

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
    $component = Factory::p();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendH1($content = null): H1 {
    $component = Factory::h1();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendH2($content = null): H2 {
    $component = Factory::h2();
    $component->append($content);
    $this->append($component);
    return $component;
  }

  public function appendArticle($content = null): Article {
    $component = Factory::article();
    $component->append($content);
    $this->append($component);
    return $component;
  }

}
