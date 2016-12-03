<?php

/**
 * Document.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Document class contains basic Sphp HTML tag component creation and HTML version handing.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-07
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Document {

  /**
   * XHTML 1.0 version
   */
  const XHTML_1_0 = "XHTML 1.0";

  /**
   * XHTML 1.1 version
   */
  const XHTML_1_1 = "XHTML 1.1";

  /**
   * HTML5 version
   */
  const HTML5 = "HTML5";

  /**
   * XHTML5 version
   */
  const XHTML5 = "XHTML5";

  /**
   * current HTML version used
   *
   * @var string
   */
  private static $htmlVersion = self::HTML5;

  /**
   * list of tags and their corresponding PHP classes
   *
   * @var string[]
   */
  private static $tags = array(
      'a' => Navigation\Hyperlink::class,
      'abbr' => ContainerTag::class,
      'address' => ContainerTag::class,
      'area' => EmptyTag::class,
      'article' => ContainerTag::class,
      'aside' => Sections\Aside::class,
      'audio' => Media\AV\Audio::class,
      'b' => ContainerTag::class,
      'base' => Head\Base::class,
      'bdi' => ContainerTag::class,
      'bdo' => ContainerTag::class,
      'big' => ContainerTag::class,
      'blockquote' => ContainerTag::class,
      'body' => Body::class,
      'br' => EmptyTag::class,
      //'button:button' => Forms\Buttons\Button::class,
      'button:reset' => Forms\Buttons\ResetButton::class,
      'button:submit' => Forms\Buttons\SubmitButton::class,
      'col' => Tables\Col::class,
      'input' => Forms\Inputs\InputTag::class,
      'input:hidden' => Forms\Inputs\HiddenInput::class,
      'input:text' => Forms\Inputs\TextInput::class,
      'input:email' => Forms\Inputs\EmailInput::class,
      'input:password' => Forms\Inputs\PasswordInput::class,
      'input:radio' => Forms\Inputs\Radiobox::class,
      'input:checkbox' => Forms\Inputs\Checkbox::class,
      'canvas' => ContainerTag::class,
      'caption' => Tables\Caption::class,
      'cite' => ContainerTag::class,
      'code' => ContainerTag::class,
      'colgroup' => Tables\Colgroup::class,
      'command' => ContainerTag::class,
      'datalist' => ContainerTag::class,
      'dd' => Lists\Dd::class,
      'del' => ContainerTag::class,
      'details' => ContainerTag::class,
      'dfn' => ContainerTag::class,
      'dialog' => ContainerTag::class,
      'dir' => ContainerTag::class,
      'div' => Div::class,
      'dl' => Lists\Dl::class,
      'dt' => Lists\Dt::class,
      'em' => ContainerTag::class,
      'embed' => Media\Embed::class,
      'fieldset' => Forms\Fieldset::class,
      'figcaption' => Media\FigCaption::class,
      'figure' => Media\Figure::class,
      'footer' => ContainerTag::class,
      'form' => Forms\Form::class,
      'head' => Head\Head::class,
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
      'i' => ContainerTag::class,
      'iframe' => Media\Iframe::class,
      'img' => Media\Img::class,
      'ins' => ContainerTag::class,
      'kbd' => ContainerTag::class,
      'keygen' => EmptyTag::class,
      'label' => Forms\Label::class,
      'legend' => Forms\Legend::class,
      'li' => Lists\Li::class,
      'link' => Head\Link::class,
      'map' => ContainerTag::class,
      'mark' => ContainerTag::class,
      'menu' => ContainerTag::class,
      'meta' => Head\Meta::class,
      'meter' => ContainerTag::class,
      'nav' => Navigation\Nav::class,
      'noscript' => Programming\Noscript::class,
      'object' => ContainerTag::class,
      'ol' => Lists\Ol::class,
      'optgroup' => Forms\Inputs\Menus\Optgroup::class,
      'option' => Forms\Inputs\Menus\Option::class,
      'output' => ContainerTag::class,
      'p' => Sections\Paragraph::class,
      'param' => EmptyTag::class,
      'pre' => ContainerTag::class,
      'progress' => ContainerTag::class,
      'q' => ContainerTag::class,
      'rp' => ContainerTag::class,
      'rt' => ContainerTag::class,
      'ruby' => ContainerTag::class,
      's' => ContainerTag::class,
      'samp' => ContainerTag::class,
      'script:code' => Programming\ScriptCode::class,
      'script:src' => Programming\ScriptSrc::class,
      'section' => Sections\Section::class,
      'select' => Forms\Inputs\Menus\Select::class,
      'small' => ContainerTag::class,
      'source' => Media\AV\Source::class,
      'span' => Span::class,
      'strong' => ContainerTag::class,
      'style' => ContainerTag::class,
      'sub' => ContainerTag::class,
      'summary' => ContainerTag::class,
      'sup' => ContainerTag::class,
      'table' => Tables\Table::class,
      'tbody' => Tables\Tbody::class,
      'td' => Tables\Td::class,
      'textarea' => Forms\Inputs\Textarea::class,
      'tfoot' => Tables\Tfoot::class,
      'th' => Tables\Th::class,
      'thead' => Tables\Thead::class,
      'time' => TimeTag::class,
      'title' => Head\Title::class,
      'tr' => Tables\Tr::class,
      'track' => Media\AV\Track::class,
      'u' => ContainerTag::class,
      'ul' => Lists\Ul::class,
      'var' => ContainerTag::class,
      'video' => Media\AV\Video::class,
      'wbr' => EmptyTag::class,
      'xmp' => ContainerTag::class
  );

  /**
   * Returns a corresponding HTML object
   *
   * @param  string $name the name of the component
   * @param  string $content the content of the tag (for nonempty tags only)
   * @return ComponentInterface the corresponding component
   * @throws \InvalidArgumentException if given tagname is invalid
   */
  public static function get($name, $content = null) {
    $tagName = strtolower($name);
    if (array_key_exists($tagName, self::$tags)) {
      $className = self::$tags[$tagName];
      if ($className == EmptyTag::class || $className == ContainerTag::class) {
        $class = new $className($tagName);
      } else {
        $class = new $className();
      }
      if ($class instanceof ContainerInterface && $content !== null) {
        $class->append($content);
      }
    } else if (mb_substr($tagName, 0, 7) === 'button:' || mb_substr($tagName, 0, 6) === 'input:') {
      $data = explode(':', $tagName);
      if ($data[0] == 'input') {
        $className = Forms\Input\Input::class;
      } else {
        $className = Forms\Buttons\ButtonTag::class;
      }
      $type = $data[1];
      $class = new $className($type);
    } else {
      throw new \InvalidArgumentException("Proper class for object '$name' can not be found");
    }
    return $class;
  }

  /**
   * 
   * @param  string $icon
   * @param  string $tagName the tag name of the component
   * @throws \InvalidArgumentException if given tagname is invalid
   */
  public static function icon($icon, $tagName = 'i') {
    return self::get($tagName)->addCssClass($icon);
  }

  /**
   * Sets HTML version used in the application
   *
   * @param string $version
   */
  public static function setHtmlVersion($version) {
    self::$htmlVersion = $version;
  }

  /**
   * Returns the HTML version used in the application
   *
   * @return string  HTML version used in the application
   */
  public static function getHtmlVersion() {
    return self::$htmlVersion;
  }

  /**
   * Checks if the current HTML version is a subtype of XHTML
   *
   * @return boolean true if the current HTML version used is a subtype of
   *         XHTML and false otherwise
   */
  public static function isXHTML() {
    return self::$htmlVersion == self::XHTML5 || self::$htmlVersion == self::XHTML_1_0 || self::$htmlVersion == self::XHTML_1_1;
  }

  /**
   * the html component
   *
   * @var Html[] 
   */
  private static $html = [];

  /**
   * Returns the html component pointed by the given name
   * 
   * @param  string $docName the name of the managed document
   * @return Html the html component pointed by the given name
   */
  public static function html($docName) {
    if (!array_key_exists($docName, self::$html)) {
      self::$html[$docName] = new Html();
    }
    return self::$html[$docName];
  }

}
