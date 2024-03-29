<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Layout;

use Sphp\Html\Content;
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
 * Interface FlowContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface FlowContainer extends Content {

  /**
   * Appends an HTML p object
   * 
   * @param  mixed $content optional content of appended component
   * @return Paragraph appended object
   */
  public function appendParagraph($content = null): Paragraph;

  /**
   * Appends an HTML h1 object
   * 
   * @param  mixed $content optional content of appended component
   * @return H1 appended object
   */
  public function appendH1(mixed $content = null): H1;

  /**
   * Appends an HTML h2 object
   * 
   * @param  mixed $content optional content of appended component
   * @return H2 appended object
   */
  public function appendH2(mixed $content = null): H2;

  /**
   * Appends an HTML h3 object
   * 
   * @param  mixed $content optional content of appended component
   * @return H3 appended object
   */
  public function appendH3(mixed $content = null): H3;

  /**
   * Appends an HTML h4 object
   * 
   * @param  mixed $content optional content of appended component
   * @return H4 appended object
   */
  public function appendH4(mixed $content = null): H4;

  /**
   * Appends an HTML h5; object
   * 
   * @param  mixed $content optional content of appended component
   * @return H5 appended object
   */
  public function appendH5(mixed $content = null): H5;

  /**
   * Appends an HTML h6 object
   * 
   * @param  mixed $content optional content of appended component
   * @return H6 appended object
   */
  public function appendH6(mixed $content = null): H6;

  /**
   * Appends an HTML hr object
   * 
   * @return Hr appended object
   */
  public function appendHr(): Hr;

  /**
   * Appends an HTML a object
   * 
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string|null $href optional URL of the link
   * @param  mixed $content optional the content of the component
   * @param  string|null $target optional value of the target attribute
   * @return A appended object
   * @link   https://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   https://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendHyperlink(?string $href = null, mixed $content = null, ?string $target = null): A;

  /**
   * Appends an HTML article object
   * 
   * @param  mixed $content optional content of appended component
   * @return Article appended object
   */
  public function appendArticle(mixed $content = null): Article;

  /**
   * Appends an HTML section object
   * 
   * @param  mixed $content optional content of appended component
   * @return Section appended object
   */
  public function appendSection(mixed $content = null): Section;

  /**
   * Appends an HTML aside object
   * 
   * @param  mixed $content optional content of appended component
   * @return Aside appended object
   */
  public function appendAside(mixed $content = null): Aside;
}
