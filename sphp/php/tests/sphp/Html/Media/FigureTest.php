<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

use PHPUnit\Framework\TestCase;

class FigureTest extends TestCase {

  /**
   * @return Figure
   */
  public function testConstructor(): Figure {
    $figure = new Figure('foo/bar', 'foo bar');
    $this->assertSame('foo/bar', $figure->getImg()->getSrc());
    $this->assertSame('foo bar', $figure->getCaption()->contentToString());
    $img = new Img('foo/bar');
    $caption = new FigCaption('foo bar');
    $figure2 = new Figure($img, $caption);
    $this->assertSame($img, $figure2->getImg());
    $this->assertSame($caption, $figure2->getCaption());
    return $figure2;
  }

  /**
   * @depends testConstructor
   * @param   Figure $fig
   * @return  Figure
   */
  public function testContentTostring(Figure $fig): Figure {
    $this->assertSame($fig->getImg() . $fig->getCaption(), $fig->contentToString());
    return $fig;
  }

  /**
   * @depends testContentTostring
   * @param   Figure $fig
   */
  public function testClone(Figure $fig) {
    $cloned = clone $fig;
    $this->assertFalse($cloned === $fig);
    $this->assertFalse($cloned->getImg() === $fig->getImg());
    $this->assertFalse($cloned->getCaption() === $fig->getCaption());
  }

}
