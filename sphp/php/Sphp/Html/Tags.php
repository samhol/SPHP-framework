<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;
use ReflectionClass;

/**
 * Factory for basic HTML tag component creation
 *
 * 
 * @method \Sphp\Html\Html html(mixed $content = null) creates a new html tag component
 * 
 * @method \Sphp\Html\Head\MetaTag meta(array $meta = []) creates a new span tag component
 * 
 * @method \Sphp\Html\Span span(mixed $content = null) creates a new span tag component
 * @method \Sphp\Html\Div div(mixed $content = null) creates a new div tag component
 * @method \Sphp\Html\Navigation\Hyperlink a(mixed $content = null) creates a new HTML &lt;a&gt; object
 * 
 * @method \Sphp\Html\Media\ImageMap\Rectangle rectangle(int $x1 = 0, int $y1 = 0, int $x2 = 0, int $y2 = 0, $href = null, $alt = null) creates a new &lt;area&gt; object
 * @method \Sphp\Html\Media\ImageMap\Polygon polygon(array $coords = null, string $href = null, string $alt = null) creates a new &lt;area&gt; object
 * @method \Sphp\Html\Media\ImageMap\Circle circle(int $x = 0, int $y = 0, int $radius = 0, string $href = null, string $alt = null) creates a new &lt;area&gt; object
 * 
 * @method \Sphp\Html\Forms\ContainerForm form(string $action = null, string $method = null, $content = null) creates a &lt;form&gt; object
 * @method \Sphp\Html\Forms\Fieldset fieldset(mixed $content = null, $for = null) creates a &lt;fieldset&gt; object
 * @method \Sphp\Html\Forms\Label label(mixed $content = null, $for = null) creates a &lt;label&gt; object
 * @method Sphp\Html\Forms\Inputs\HiddenInput hiddenInput(mixed $content = null, $for = null) creates a &lt;input type=hidden&gt; object
 * @method Sphp\Html\Forms\Inputs\TextInput textInput(mixed $content = null, $for = null) creates a &lt;input type=text&gt; object
 * @method Sphp\Html\Forms\Inputs\Radiobox radio(mixed $content = null, $for = null) creates a &lt;input type=radio&gt; object
 * 
 * @method \Sphp\Html\Flow\Headings\H1 h1(mixed $content = null) creates a new HTML &lt;h1&gt; object
 * @method \Sphp\Html\Flow\Headings\H2 h2(mixed $content = null) creates a new HTML &lt;h2&gt; object
 * @method \Sphp\Html\Flow\Headings\H3 h3(mixed $content = null) creates a new HTML &lt;h3&gt; object
 * @method \Sphp\Html\Flow\Headings\H4 h4(mixed $content = null) creates a new HTML &lt;h4&gt; object
 * @method \Sphp\Html\Flow\Headings\H5 h5(mixed $content = null) creates a new HTML &lt;h5&gt; object
 * @method \Sphp\Html\Flow\Headings\H6 h6(mixed $content = null) creates a new HTML &lt;h6&gt; object
 * 
 * @method \Sphp\Html\Flow\Main main(mixed $content = null) creates a new HTML &lt;main&gt; object
 * @method \Sphp\Html\Flow\Section section(mixed $content = null) creates a new HTML &lt;section&gt; object
 * @method \Sphp\Html\Flow\Footer footer(mixed $content = null) creates a new HTML &lt;footer&gt; object
 * @method \Sphp\Html\Flow\Aside aside(mixed $content = null) creates a new HTML &lt;aside&gt; object
 * @method \Sphp\Html\Flow\Article article(mixed $content = null) creates a new HTML &lt;article&gt; object
 * @method \Sphp\Html\Flow\Paragraph p(mixed $content = null) creates a new HTML &lt;p&gt; object
 * 
 * @method \Sphp\Html\Tables\Table table(mixed $caption = null) creates a new HTML &lt;table&gt; object
 * @method \Sphp\Html\Tables\Caption caption(mixed $content = null) creates a new HTML &lt;caption&gt; object
 * @method \Sphp\Html\Tables\Colgroup colgroup() creates a new HTML &lt;colgroup&gt; object
 * @method \Sphp\Html\Tables\Col col(int $span = 1) creates a new HTML &lt;col&gt; object
 * @method \Sphp\Html\Tables\Thead thead() creates a new HTML &lt;thead&gt; object
 * @method \Sphp\Html\Tables\Tbody tbody() creates a new HTML &lt;tbody&gt; object
 * @method \Sphp\Html\Tables\Tfoot tfoot() creates a new HTML &lt;tfoot&gt; object
 * @method \Sphp\Html\Tables\Tr tr() creates a new HTML &lt;tr&gt; object
 * @method \Sphp\Html\Tables\Th th(mixed $content = null, int $colspan = 1, int $rowspan = 1, string $scope = null) creates a new HTML &lt;th&gt; object
 * @method \Sphp\Html\Tables\Td td(mixed $content = null, int $colspan = 1, int $rowspan = 1) creates a new HTML &lt;td&gt; object
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class Tags {

  /**
   * list of tags and their corresponding PHP classes
   *
   * @var mixed[]
   */
  private static $tags = array(
      'a' => Navigation\Hyperlink::class,
      'aside' => Flow\Aside::class,
      'base' => Head\Base::class,
      'body' => Body::class,
      'form' => Forms\ContainerForm::class,
      'label' => Forms\Label::class,
      'legend' => Forms\Legend::class,
      'fieldset' => Forms\Fieldset::class,
      'pushButton' => Forms\Buttons\Button::class,
      'resetButton' => Forms\Buttons\Resetter::class,
      'submitButton' => Forms\Buttons\Submitter::class,
      //'input' => Forms\Inputs\InputTag::class,
      'hiddenInput' => Forms\Inputs\HiddenInput::class,
      'textInput' => Forms\Inputs\TextInput::class,
      'emailInput' => Forms\Inputs\EmailInput::class,
      'passwordInput' => Forms\Inputs\PasswordInput::class,
      'radio' => Forms\Inputs\Radiobox::class,
      'checkbox' => Forms\Inputs\Checkbox::class,
      'numberInput' => Forms\Inputs\NumberInput::class,
      'resetInput' => Forms\Inputs\Buttons\ResetInput::class,
      'submitInput' => Forms\Inputs\Buttons\SubmitInput::class,
      'optgroup' => Forms\Inputs\Menus\Optgroup::class,
      'option' => Forms\Inputs\Menus\Option::class,
      'textarea' => Forms\Inputs\Textarea::class,
      'canvas' => ContainerTag::class,
      'caption' => Tables\Caption::class,
      'cite' => ContainerTag::class,
      'datalist' => ContainerTag::class,
      'dd' => Lists\Dd::class,
      'div' => Div::class,
      'figure' => Media\Figure::class,
      'header' => ContainerTag::class,
      'main' => Flow\Main::class,
      'footer' => Flow\Footer::class,
      'h1' => Flow\Headings\H1::class,
      'h2' => Flow\Headings\H2::class,
      'h3' => Flow\Headings\H3::class,
      'h4' => Flow\Headings\H4::class,
      'h5' => Flow\Headings\H5::class,
      'h6' => Flow\Headings\H6::class,
      'html' => Html::class,
      'keygen' => EmptyTag::class,
      'link' => Head\LinkTag::class,
      'menu' => ContainerTag::class,
      'head' => Head\Head::class,
      'meta' => Head\MetaTag::class,
      'title' => Head\Title::class,
      'meter' => ContainerTag::class,
      'nav' => Navigation\Nav::class,
      'ol' => Lists\Ol::class,
      'ul' => Lists\Ul::class,
      'li' => Lists\Li::class,
      'dl' => Lists\Dl::class,
      'dt' => Lists\Dt::class,
      'output' => ContainerTag::class,
      'p' => Flow\Paragraph::class,
      'article' => Flow\Article::class,
      'scriptCode' => Scripts\ScriptCode::class,
      'scriptSrc' => Scripts\ScriptSrc::class,
      'noscript' => Scripts\Noscript::class,
      'section' => Flow\Section::class,
      'select' => Forms\Inputs\Menus\Select::class,
      'iframe' => Media\Iframe::class,
      'img' => Media\Img::class,
      'map' => Media\ImageMap\Map::class,
      'rectangle' => Media\ImageMap\Rectangle::class,
      'polygon' => Media\ImageMap\Polygon::class,
      'circle' => Media\ImageMap\Circle::class,
      'figcaption' => Media\FigCaption::class,
      'embed' => Media\Multimedia\Embed::class,
      'audio' => Media\Multimedia\Audio::class,
      'source' => Media\Multimedia\Source::class,
      'track' => Media\Multimedia\Track::class,
      'video' => Media\Multimedia\Video::class,
      'object' => Media\Multimedia\ObjectTag::class,
      'param' => Media\Multimedia\Param::class,
      'span' => Span::class,
      'table' => Tables\Table::class,
      'tbody' => Tables\Tbody::class,
      'td' => Tables\Td::class,
      'tfoot' => Tables\Tfoot::class,
      'tr' => Tables\Tr::class,
      'th' => Tables\Th::class,
      'thead' => Tables\Thead::class,
      'colgroup' => Tables\Colgroup::class,
      'col' => Tables\Col::class,
      'time' => DateTime\TimeTag::class,
      'pre' => ContainerTag::class,
      'progress' => ContainerTag::class,
      'i' => ContainerTag::class,
      'blockquote' => ContainerTag::class,
      'address' => ContainerTag::class,
      'style' => ContainerTag::class,
      'wbr' => EmptyTag::class,
  );

  /**
   * 
   * @return string[]
   */
  public static function getTagMap(): array {
    return static::$tags;
  }

  /**
   * Creates a HTML object
   *
   * @param  string $name the name of the component
   * @param  array $arguments 
   * @return Tag the corresponding component
   * @throws BadMethodCallException if the tag object does not exist
   */
  public static function __callStatic(string $name, array $arguments): Tag {
    try {
      return static::create($name, $arguments);
    } catch (\Exception $ex) {
      throw new BadMethodCallException("Method '$name' Does not exist", 0, $ex);
    }
  }

  /**
   * Creates a HTML object
   *
   * @param  string $name the name of the component
   * @param  array $arguments 
   * @return Tag the corresponding component
   * @throws InvalidArgumentException if the tag object does not exist
   */
  public static function create(string $name, array $arguments = []): Tag {
    if (!isset(static::$tags[$name])) {
      throw new InvalidArgumentException("Method $name does not exist");
    }
    $reflectionClass = new ReflectionClass(static::$tags[$name]);
    if ($reflectionClass->getName() == EmptyTag::class || $reflectionClass->getName() == ContainerTag::class) {
      array_unshift($arguments, $name);
    }
    $instance = $reflectionClass->newInstanceArgs($arguments);
    return $instance;
  }

}
