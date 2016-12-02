<?php

/**
 * Track.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\AV;

use Sphp\Html\EmptyTag;
use Sphp\Core\Types\URL;

/**
 * Class Models an HTML &lt;track&gt; tag
 *
 *  This component specifies text tracks for {@link AbstractMediaTag} media 
 *  components. It is used to specify subtitles, caption files or other files 
 *  containing text, that should be visible when the media is playing.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-14
 * @link    http://www.w3schools.com/tags/tag_track.asp w3schools API
 * @link    http://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-track-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Track extends EmptyTag implements MultimediaContentInterface {

  /**
   * Constructs a new instance
   *
   * @param  string|URL $src the URL of the media file
   * @param  string $srclang the language of the track text data
   * @link   http://www.w3schools.com/tags/att_track_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_track_srclang.asp srclang attribute
   */
  public function __construct($src = false, $srclang = false) {
    parent::__construct('track');
    $this
            ->setSrc($src)
            ->setSrcLang($srclang);
  }

  /**
   * Sets or unsets the track as default component
   * 
   * When a track is set as default, it specifies that the track is to be 
   * enabled if the user's preferences do not indicate that another track 
   * would be more appropriate.
   * 
   * **Note:** There must not be more than one {@link self} component with a 
   * default attribute per {@link AbstractMediaTag} component.
   *
   * @param  boolean $default true if the track is default, otherwise false
   * @return self for PHP Method Chaining
   */
  public function setDefault($default = true) {
    return $this->setAttr('default', (bool) $default);
  }

  /**
   * Checks whether the option is enabled or not
   * 
   * @param  boolean true if the track is default, otherwise false
   */
  public function isDefault() {
    return $this->attrExists('default');
  }

  /**
   * Sets the path to the track source (The URL of the track file)
   *
   * @param  string|URL $src the path to the track source (The URL of the track file)
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_track_src.asp src attribute
   */
  public function setSrc($src) {
    return $this->setAttr('src', $src);
  }

  /**
   * Returns the URL of the track file
   * 
   * @return string the URL of the track file
   * @link   http://www.w3schools.com/tags/att_track_src.asp src attribute
   */
  public function getSrc() {
    return $this->getAttr('src');
  }

  /**
   * Sets the kind of text track
   *
   *  **Attribute Values:**
   * 
   * * `captions`:	The track defines translation of dialogue and sound effects (suitable for deaf users)
   * * `chapters`:	The track defines chapter titles (suitable for navigating the media resource)
   * * `descriptions`:	The track defines a textual description of the video content (suitable for blind users)
   * * `metadata`:	The track defines content used by scripts. Not visible for the user
   * * `subtitles`:	The track defines subtitles, used to display subtitles in a video
   * 
   * @param  string $kind specifies the kind of text track
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_track_kind.asp kind attribute
   */
  public function setKind($kind) {
    return $this->setAttr('kind', $kind);
  }

  /**
   * Returns the kind of text track
   *
   *  **Returned Values:**
   * 
   * * `captions`:	The track defines translation of dialogue and sound effects (suitable for deaf users)
   * * `chapters`:	The track defines chapter titles (suitable for navigating the media resource)
   * * `descriptions`:	The track defines a textual description of the video content (suitable for blind users)
   * * `metadata`:	The track defines content used by scripts. Not visible for the user
   * * `subtitles`:	The track defines subtitles, used to display subtitles in a video
   *
   * @return string the kind of text track
   * @link   http://www.w3schools.com/tags/att_track_kind.asp kind attribute
   */
  public function getKind() {
    return $this->getAttr('kind');
  }

  /**
   * Sets the language of the track text data
   *
   * **Important:** This is required if the  kind is "subtitles".
   * 
   * @param  string $srclang the language of the track text data
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_track_srclang.asp srclang attribute
   * @link   http://www.w3schools.com/tags/ref_language_codes.asp HTML Language Code Reference
   */
  public function setSrcLang($srclang) {
    return $this->setAttr('srclang', $srclang);
  }

  /**
   * Returns the language of the track text data
   * 
   * @return string the language of the track text data
   * @link   http://www.w3schools.com/tags/att_track_srclang.asp srclang attribute
   * @link   http://www.w3schools.com/tags/ref_language_codes.asp HTML Language Code Reference
   */
  public function getSrcLang() {
    return $this->getAttr('srclang');
  }

  /**
   * Sets the label of the track text data
   *
   * **Important:** This is required if the  kind is "subtitles".
   * 
   * @param  string $label the label of the track text data
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_track_label.asp label attribute
   */
  public function setLabel($label) {
    return $this->setAttr('label', $label);
  }

  /**
   * Returns the label of the track text data
   * 
   * @return string the label of the track text data
   * @link   http://www.w3schools.com/tags/att_track_label.asp label attribute
   */
  public function getLabel() {
    return $this->getAttr('label');
  }

}
