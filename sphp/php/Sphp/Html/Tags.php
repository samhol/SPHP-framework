<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
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
 * @method static \Sphp\Html\Navigation\A a(mixed $content = null) creates a new hyperlink tag 
 * 
 * @method static \Sphp\Html\Html html(mixed $content = null) creates a new html tag
 * 
 * @method static \Sphp\Html\Head\MetaTag meta(array $meta = []) creates a new span tag
 * 
 * @method static \Sphp\Html\Code\Var var() creates a new var tag
 * 
 * @method static \Sphp\Html\Text\Headings\H1 h1(mixed $content = null) creates a new HTML &lt;h1&gt; object
 * @method static \Sphp\Html\Text\Headings\H2 h2(mixed $content = null) creates a new HTML &lt;h2&gt; object
 * @method static \Sphp\Html\Text\Headings\H3 h3(mixed $content = null) creates a new HTML &lt;h3&gt; object
 * @method static \Sphp\Html\Text\Headings\H4 h4(mixed $content = null) creates a new HTML &lt;h4&gt; object
 * @method static \Sphp\Html\Text\Headings\H5 h5(mixed $content = null) creates a new HTML &lt;h5&gt; object
 * @method static \Sphp\Html\Text\Headings\H6 h6(mixed $content = null) creates a new HTML &lt;h6&gt; object
 * 
 * @method static \Sphp\Html\Text\Hr hr() creates a new hr tag
 * @method static \Sphp\Html\Text\Span span(mixed $content = null) creates a new span tag 
 * @method static \Sphp\Html\Text\Strong strong(mixed $content = null) creates a new strong tag 
 * @method static \Sphp\Html\Text\Paragraph p(mixed $content = null) creates a new paragraph tag
 * @method static \Sphp\Html\Text\Paragraph paragraph(mixed $content = null) creates a new paragraph tag
 * @method static \Sphp\Html\Text\Time time(mixed $content = null) creates a new time tag
 * 
 * @method static \Sphp\Html\Media\Canvas canvas() creates a new HTML &lt;canvas&gt; object
 * @method static \Sphp\Html\Media\ImageMap\Rectangle rectangle(int $x1 = 0, int $y1 = 0, int $x2 = 0, int $y2 = 0) creates a new &lt;area&gt; object
 * @method static \Sphp\Html\Media\ImageMap\Polygon polygon(int ... $coord) creates a new &lt;area shape="poly"&gt; object
 * @method static \Sphp\Html\Media\ImageMap\Circle circle(int $x = 0, int $y = 0, int $radius = 0, string $href = null, string $alt = null) creates a new &lt;area&gt; object
 * 
 * @method static \Sphp\Html\Forms\Form form(string $action = null, string $method = null, $content = null) creates a &lt;form&gt; object
 * @method static \Sphp\Html\Forms\Fieldset fieldset(mixed $content = null, $for = null) creates a &lt;fieldset&gt; object
 * @method static \Sphp\Html\Forms\Label label(mixed $content = null, $for = null) creates a &lt;label&gt; object
 * @method static \Sphp\Html\Forms\Inputs\HiddenInput hiddenInput(mixed $content = null, $for = null) creates a &lt;input type=hidden&gt; object
 * @method static \Sphp\Html\Forms\Inputs\TextInput textInput(mixed $content = null, $for = null) creates a &lt;input type=text&gt; object
 * @method static \Sphp\Html\Forms\Inputs\Radiobox radio(mixed $content = null, $for = null) creates a &lt;input type=radio&gt; object
 * 
 * @method static \Sphp\Html\Layout\Main main(mixed $content = null) creates a new HTML &lt;main&gt; object
 * @method static \Sphp\Html\Layout\Section section(mixed $content = null) creates a new HTML &lt;section&gt; object
 * @method static \Sphp\Html\Layout\Footer footer(mixed $content = null) creates a new HTML &lt;footer&gt; object
 * @method static \Sphp\Html\Layout\Aside aside(mixed $content = null) creates a new HTML &lt;aside&gt; object
 * @method static \Sphp\Html\Layout\Article article(mixed $content = null) creates a new HTML &lt;article&gt; object
 * @method static \Sphp\Html\Layout\Div div(mixed $content = null) creates a new div tag component
 * 
 * @method static \Sphp\Html\Tables\Table table(mixed $caption = null) creates a new HTML &lt;table&gt; object
 * @method static \Sphp\Html\Tables\Caption caption(mixed $content = null) creates a new HTML &lt;caption&gt; object
 * @method static \Sphp\Html\Tables\Thead thead() creates a new HTML &lt;thead&gt; object
 * @method static \Sphp\Html\Tables\Tbody tbody() creates a new HTML &lt;tbody&gt; object
 * @method static \Sphp\Html\Tables\Tfoot tfoot() creates a new HTML &lt;tfoot&gt; object
 * @method static \Sphp\Html\Tables\Tr tr() creates a new HTML tr object
 * @method static \Sphp\Html\Tables\Th th(mixed $content = null, int $colspan = 1, int $rowspan = 1, string $scope = null) creates a new HTML &lt;th&gt; object
 * @method static \Sphp\Html\Tables\Td td(mixed $content = null, int $colspan = 1, int $rowspan = 1) creates a new HTML &lt;td&gt; object
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
      'a' => Navigation\A::class,
      'hyperlink' => Navigation\A::class,
      'base' => Head\Base::class,
      'body' => Body::class,
      /**
       * Forms:
       */
      'form' => Forms\Form::class,
      'label' => Forms\Label::class,
      'legend' => Forms\Legend::class,
      'fieldset' => Forms\Fieldset::class,
      'pushButton' => Forms\Buttons\PushButton::class,
      'resetButton' => Forms\Buttons\ResetButton::class,
      'submitButton' => Forms\Buttons\SubmitButton::class,
      //'input' => Forms\Inputs\InputTag::class,
      'hiddenInput' => Forms\Inputs\HiddenInput::class,
      'textInput' => Forms\Inputs\TextInput::class,
      'emailInput' => Forms\Inputs\EmailInput::class,
      'passwordInput' => Forms\Inputs\PasswordInput::class,
      'radio' => Forms\Inputs\Radiobox::class,
      'radioBox' => Forms\Inputs\Radiobox::class,
      'radioInput' => Forms\Inputs\Radiobox::class,
      'checkbox' => Forms\Inputs\Checkbox::class,
      'numberInput' => Forms\Inputs\NumberInput::class,
      'resetInput' => Forms\Inputs\Buttons\ResetInput::class,
      'submitInput' => Forms\Inputs\Buttons\SubmitInput::class,
      'select' => Forms\Inputs\Menus\Select::class,
      'optgroup' => Forms\Inputs\Menus\Optgroup::class,
      'option' => Forms\Inputs\Menus\Option::class,
      'textarea' => Forms\Inputs\Textarea::class,
      'canvas' => ContainerTag::class,
      'caption' => Tables\Caption::class,
      'cite' => ContainerTag::class,
      'datalist' => ContainerTag::class,
      'dd' => Lists\Dd::class,
      /**
       * Layout:
       */
      'div' => Layout\Div::class,
      'section' => Layout\Section::class,
      'article' => Layout\Article::class,
      'aside' => Layout\Aside::class,
      'header' => Layout\Header::class,
      'main' => Layout\Main::class,
      'footer' => Layout\Footer::class,
      /**
       * Media:
       */
      'figure' => Media\Figure::class,
      
      'html' => Html::class,
      'link' => Head\Links\LinkTag::class,
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
      'InlineScript' => Scripts\InlineScript::class,
      'script' => Scripts\ExternalScript::class,
      'noscript' => Scripts\Noscript::class,
      /**
       * Media:
       */
      'iframe' => Media\Multimedia\Iframe::class,
      'img' => Media\Pictures\Img::class,
      'figure' => Media\Pictures\Figure::class,
      'figcaption' => Media\Pictures\FigCaption::class,
      'canvas' => Media\Pictures\Canvas::class,
      'map' => Media\ImageMap\Map::class,
      'rectangle' => Media\ImageMap\Rectangle::class,
      'polygon' => Media\ImageMap\Polygon::class,
      'circle' => Media\ImageMap\Circle::class,
      'embed' => Media\Multimedia\Embed::class,
      'audio' => Media\Multimedia\Audio::class,
      'source' => Media\Multimedia\Source::class,
      'track' => Media\Multimedia\Track::class,
      'video' => Media\Multimedia\Video::class,
      'object' => Media\Multimedia\ObjectTag::class,
      'param' => Media\Multimedia\Param::class,
      /**
       * Table:
       */
      'table' => Tables\Table::class,
      'tbody' => Tables\Tbody::class,
      'td' => Tables\Td::class,
      'tfoot' => Tables\Tfoot::class,
      'tr' => Tables\Tr::class,
      'th' => Tables\Th::class,
      'thead' => Tables\Thead::class,
      'progress' => ContainerTag::class,
      /**
       * Text:
       */
      'h1' => Text\Headings\H1::class,
      'h2' => Text\Headings\H2::class,
      'h3' => Text\Headings\H3::class,
      'h4' => Text\Headings\H4::class,
      'h5' => Text\Headings\H5::class,
      'h6' => Text\Headings\H6::class,
      'p' => Text\Paragraph::class,
      'paragraph' => Text\Paragraph::class,
      'i' => Text\I::class,
      'strong' => Text\Strong::class,
      'small' => Text\Small::class,
      'span' => Text\Span::class,
      'blockquote' => Text\Blockquote::class,
      'hr' => Text\Hr::class,
      'time' => Text\Time::class,
      'address' => ContainerTag::class,
      'style' => ContainerTag::class,
      'wbr' => EmptyTag::class,
      /**
       * Code:
       */
      'var' => Code\Variable::class,
      'code' => Code\Code::class,
      'pre' => Code\Pre::class,
  );

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
      return static::create($name, ...$arguments);
    } catch (\Exception $ex) {
      throw new BadMethodCallException("Method '$name' Does not exist", 0, $ex);
    }
  }

  /**
   * Creates a HTML object
   *
   * @param  string $name the name of the component
   * @param  mixed ... $arguments 
   * @return Tag the corresponding component
   * @throws InvalidArgumentException if the tag object does not exist
   */
  public static function create(string $name, mixed...$arguments): Tag {
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
