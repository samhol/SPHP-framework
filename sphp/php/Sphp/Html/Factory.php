<?php

/**
 * Factory.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Exceptions\BadMethodCallException;
use ReflectionClass;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Media\ImageMap\Rectangle;
use Sphp\Html\Media\ImageMap\Circle;
use Sphp\Html\Media\ImageMap\Polygon;
use Sphp\Html\Headings\H1;
use Sphp\Html\Headings\H2;
use Sphp\Html\Headings\H3;
use Sphp\Html\Headings\H4;
use Sphp\Html\Headings\H5;
use Sphp\Html\Headings\H6;

/**
 * Document class contains basic Sphp HTML tag component creation and HTML version handing.
 *
 * 
 * @method Span span(mixed $content = null) creates a new span tag component
 * @method Div div(mixed $content = null) creates a new div tag component
 * @method Hyperlink a(mixed $content = null) creates a new div tag component
 * @method Rectangle rectangle(mixed $content = null) creates a new div tag component
 * @method Polygon polygon(mixed $content = null) creates a new div tag component
 * @method ContainerTag article(mixed $content = null) creates a new div tag component
 * 
 * @method H1 h1(mixed $content = null) creates a new `h1` tag component
 * @method H2 h2(mixed $content = null) creates a new `h2` tag component
 * @method H3 h3(mixed $content = null) creates a new `h3` tag component
 * @method H4 h4(mixed $content = null) creates a new `h4` tag component
 * @method H5 h5(mixed $content = null) creates a new `h5` tag component
 * @method H6 h6(mixed $content = null) creates a new `h6` tag component
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Factory {

  /**
   * list of tags and their corresponding PHP classes
   *
   * @var string[]
   */
  private static $tags = array(
      'a' => Hyperlink::class,
      'abbr' => ContainerTag::class,
      'address' => ContainerTag::class,
      'rectangle' => Rectangle::class,
      'polygon' => Polygon::class,
      'circle' => Circle::class,
      'aside' => Sections\Aside::class,
      'base' => Head\Base::class,
      'body' => Body::class,
      'br' => EmptyTag::class,
      'form' => Forms\Form::class,
      'label' => Forms\Label::class,
      'legend' => Forms\Legend::class,
      'fieldset' => Forms\Fieldset::class,
      'pushButton' => Forms\Buttons\Button::class,
      'resetButton' => Forms\Buttons\Resetter::class,
      'submitButton' => Forms\Buttons\Submitter::class,
      'input' => Forms\Inputs\InputTag::class,
      'hiddenInput' => Forms\Inputs\HiddenInput::class,
      'textInput' => Forms\Inputs\TextInput::class,
      'emailInput' => Forms\Inputs\EmailInput::class,
      'passwordInput' => Forms\Inputs\PasswordInput::class,
      'radiobox' => Forms\Inputs\Radiobox::class,
      'checkbox' => Forms\Inputs\Checkbox::class,
      'numberInput' => Forms\Inputs\NumberInput::class,
      'resetInput' => Forms\Inputs\Buttons\Resetter::class,
      'submitInput' => Forms\Inputs\Buttons\Submitter::class,
      'optgroup' => Forms\Inputs\Menus\Optgroup::class,
      'option' => Forms\Inputs\Menus\Option::class,
      'textarea' => Forms\Inputs\Textarea::class,
      'canvas' => ContainerTag::class,
      'caption' => Tables\Caption::class,
      'cite' => ContainerTag::class,
      'code' => ContainerTag::class,
      'command' => ContainerTag::class,
      'datalist' => ContainerTag::class,
      'dd' => Lists\Dd::class,
      'del' => ContainerTag::class,
      'details' => ContainerTag::class,
      'dfn' => ContainerTag::class,
      'dialog' => ContainerTag::class,
      'dir' => ContainerTag::class,
      'div' => Div::class,
      'em' => ContainerTag::class,
      'figure' => Media\Figure::class,
      'footer' => ContainerTag::class,
      'header' => ContainerTag::class,
      'hgroup' => ContainerTag::class,
      'h1' => Headings\H1::class,
      'h2' => Headings\H2::class,
      'h3' => Headings\H3::class,
      'h4' => Headings\H4::class,
      'h5' => Headings\H5::class,
      'h6' => Headings\H6::class,
      'hr' => EmptyTag::class,
      'html' => Html::class,
      'ins' => ContainerTag::class,
      'kbd' => ContainerTag::class,
      'keygen' => EmptyTag::class,
      'link' => Head\Link::class,
      'mark' => ContainerTag::class,
      'menu' => ContainerTag::class,
      'head' => Head\Head::class,
      'meta' => Head\Meta::class,
      'title' => Head\Title::class,
      'meter' => ContainerTag::class,
      'nav' => Navigation\Nav::class,
      'object' => ContainerTag::class,
      'ol' => Lists\Ol::class,
      'ul' => Lists\Ul::class,
      'li' => Lists\Li::class,
      'dl' => Lists\Dl::class,
      'dt' => Lists\Dt::class,
      'output' => ContainerTag::class,
      'p' => Sections\Paragraph::class,
      'param' => EmptyTag::class,
      'scriptCode' => Programming\ScriptCode::class,
      'scriptSrc' => Programming\ScriptSrc::class,
      'noscript' => Programming\Noscript::class,
      'section' => Sections\Section::class,
      'select' => Forms\Inputs\Menus\Select::class,
      'iframe' => Media\Iframe::class,
      'img' => Media\Img::class,
      'map' => Media\ImageMap\Map::class,
      'figcaption' => Media\FigCaption::class,
      'embed' => Media\Multimedia\Embed::class,
      'audio' => Media\Multimedia\Audio::class,
      'source' => Media\Multimedia\Source::class,
      'track' => Media\Multimedia\Track::class,
      'video' => Media\Multimedia\Video::class,
      'span' => Span::class,
      'strong' => ContainerTag::class,
      'style' => ContainerTag::class,
      'sub' => ContainerTag::class,
      'summary' => ContainerTag::class,
      'sup' => ContainerTag::class,
      'table' => Tables\Table::class,
      'tbody' => Tables\Tbody::class,
      'td' => Tables\Td::class,
      'tfoot' => Tables\Tfoot::class,
      'tr' => Tables\Tr::class,
      'th' => Tables\Th::class,
      'thead' => Tables\Thead::class,
      'colgroup' => Tables\Colgroup::class,
      'col' => Tables\Col::class,
      'time' => TimeTag::class,
      'var' => ContainerTag::class,
      'xmp' => ContainerTag::class,
      'pre' => ContainerTag::class,
      'progress' => ContainerTag::class,
      'q' => ContainerTag::class,
      'rp' => ContainerTag::class,
      'rt' => ContainerTag::class,
      'ruby' => ContainerTag::class,
      's' => ContainerTag::class,
      'samp' => ContainerTag::class,
      'u' => ContainerTag::class,
      'i' => ContainerTag::class,
      'bdi' => ContainerTag::class,
      'bdo' => ContainerTag::class,
      'big' => ContainerTag::class,
      'blockquote' => ContainerTag::class,
      'article' => ContainerTag::class,
      'b' => ContainerTag::class,
      'small' => ContainerTag::class,
      'wbr' => EmptyTag::class,
  );

  /**
   * Creates a HTML object
   *
   * @param  string $name the name of the component
   * @param  array $arguments 
   * @return TagInterface the corresponding component
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $arguments): TagInterface {
    if (!isset(static::$tags[$name])) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    if (is_string(static::$tags[$name])) {
      static::$tags[$name] = new ReflectionClass(static::$tags[$name]);
    }
    $reflectionClass = static::$tags[$name];
    if ($reflectionClass->getName() == EmptyTag::class || $reflectionClass->getName() == ContainerTag::class) {
      array_unshift($arguments, $name);
    }
    $instance = static::$tags[$name]->newInstanceArgs($arguments);
    return $instance;
  }

}
