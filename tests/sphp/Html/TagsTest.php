<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;

class TagsTest extends TestCase {

  /**
   * @return string[]
   */
  public function tags(): array {
    return [
        ['a', Navigation\Hyperlink::class,],
        ['aside', Flow\Aside::class,],
        ['base', Head\Base::class,],
        ['body', Body::class],
        ['br', EmptyTag::class],
        ['form', Forms\Form::class],
        ['label', Forms\Label::class],
        ['legend', Forms\Legend::class],
        ['fieldset', Forms\Fieldset::class],
        ['pushButton', Forms\Buttons\Button::class],
        ['resetButton', Forms\Buttons\Resetter::class],
        ['submitButton', Forms\Buttons\Submitter::class,],
        //['input', Forms\Inputs\InputTag::class,],
        ['hiddenInput', Forms\Inputs\HiddenInput::class],
        ['textInput', Forms\Inputs\TextInput::class],
        ['emailInput', Forms\Inputs\EmailInput::class],
        ['passwordInput', Forms\Inputs\PasswordInput::class],
        ['radiobox', Forms\Inputs\Radiobox::class],
        ['checkbox', Forms\Inputs\Checkbox::class],
        ['numberInput', Forms\Inputs\NumberInput::class],
        ['resetInput', Forms\Inputs\Buttons\Resetter::class],
        ['submitInput', Forms\Inputs\Buttons\Submitter::class],
        ['optgroup', Forms\Inputs\Menus\Optgroup::class],
        ['option', Forms\Inputs\Menus\Option::class],
        ['textarea', Forms\Inputs\Textarea::class],
        ['canvas', ContainerTag::class],
        ['cite', ContainerTag::class],
        ['code', ContainerTag::class],
        ['command', ContainerTag::class],
        ['datalist', ContainerTag::class],
        ['dd', Lists\Dd::class],
        ['del', ContainerTag::class],
        ['details', ContainerTag::class],
        ['dfn', ContainerTag::class],
        ['dialog', ContainerTag::class],
        ['dir', ContainerTag::class],
        ['div', Div::class],
        ['em', ContainerTag::class],
        ['figure', Media\Figure::class],
        ['header', ContainerTag::class],
        ['main', Flow\Main::class],
        ['footer', Flow\Footer::class],
        ['hgroup', ContainerTag::class],
        ['h1', Flow\Headings\H1::class],
        ['h2', Flow\Headings\H2::class],
        ['h3', Flow\Headings\H3::class],
        ['h4', Flow\Headings\H4::class],
        ['h5', Flow\Headings\H5::class],
        ['h6', Flow\Headings\H6::class],
        ['hr', EmptyTag::class],
        ['html', Html::class],
        ['ins', ContainerTag::class],
        ['kbd', ContainerTag::class],
        ['keygen', EmptyTag::class],
        ['link', Head\LinkTag::class],
        ['mark', ContainerTag::class],
        ['menu', ContainerTag::class],
        ['head', Head\Head::class],
        ['meta', Head\MetaTag::class],
        ['title', Head\Title::class],
        ['meter', ContainerTag::class],
        ['nav', Navigation\Nav::class],
        ['ol', Lists\Ol::class],
        ['ul', Lists\Ul::class],
        ['li', Lists\Li::class],
        ['dl', Lists\Dl::class],
        ['dt', Lists\Dt::class],
        ['output', ContainerTag::class],
        ['p', Flow\Paragraph::class],
        ['article', Flow\Article::class],
        ['param', Media\Multimedia\Param::class],
        ['scriptCode', Scripts\ScriptCode::class],
        ['scriptSrc', Scripts\ScriptSrc::class],
        ['noscript', Scripts\Noscript::class],
        ['section', Flow\Section::class],
        ['select', Forms\Inputs\Menus\Select::class],
        ['iframe', Media\Iframe::class],
        ['img', Media\Img::class],
        ['map', Media\ImageMap\Map::class],
        ['rectangle', Media\ImageMap\Rectangle::class],
        ['polygon', Media\ImageMap\Polygon::class],
        ['circle', Media\ImageMap\Circle::class],
        ['figcaption', Media\FigCaption::class],
        ['embed', Media\Multimedia\Embed::class],
        ['audio', Media\Multimedia\Audio::class],
        ['source', Media\Multimedia\Source::class],
        ['track', Media\Multimedia\Track::class],
        ['video', Media\Multimedia\Video::class],
        ['object', Media\Multimedia\ObjectTag::class],
        ['span', Span::class],
        ['table', Tables\Table::class],
        ['caption', Tables\Caption::class],
        ['tbody', Tables\Tbody::class],
        ['td', Tables\Td::class],
        ['tfoot', Tables\Tfoot::class],
        ['tr', Tables\Tr::class],
        ['th', Tables\Th::class],
        ['thead', Tables\Thead::class],
        ['colgroup', Tables\Colgroup::class],
        ['col', Tables\Col::class,],
        ['time', DateTime\TimeTag::class,],
        ['var', ContainerTag::class],
        ['xmp', ContainerTag::class],
        ['pre', ContainerTag::class],
        ['progress', ContainerTag::class],
        ['q', ContainerTag::class],
        ['rp', ContainerTag::class],
        ['rt', ContainerTag::class],
        ['ruby', ContainerTag::class],
        ['s', ContainerTag::class],
        ['samp', ContainerTag::class],
        ['u', ContainerTag::class],
        ['i', ContainerTag::class],
        ['bdi', ContainerTag::class],
        ['bdo', ContainerTag::class],
        ['big', ContainerTag::class],
        ['blockquote', ContainerTag::class],
        ['b', ContainerTag::class],
        ['small', ContainerTag::class],
        ['abbr', ContainerTag::class],
        ['address', ContainerTag::class],
        ['strong', ContainerTag::class],
        ['style', ContainerTag::class],
        ['sub', ContainerTag::class],
        ['summary', ContainerTag::class],
        ['sup', ContainerTag::class],
        ['wbr', EmptyTag::class]
    ];
  }

  /**
   * @dataProvider tags
   * 
   * @param string $val
   * @param string $className
   */
  public function testFactoring(string $val, string $className) {
    $this->assertInstanceOf($className, Tags::create($val));
    $this->assertInstanceOf($className, Tags::$val());
    $str = Tags::create($val);
    $this->assertTrue(\Sphp\Stdlib\Strings::contains("$str", "<" . $str->getTagName()));
  }

  public function testInvalidCreateMethodCall() {
    $this->expectException(InvalidArgumentException::class);
    Tags::create('foo');
  }

  public function testInvalidMagicCall() {
    $this->expectException(BadMethodCallException::class);
    Tags::foo('foo');
  }

}
