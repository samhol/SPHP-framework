<?php

/**
 * UsernameInputElement.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Input;

/**
 * Class Models käyttäjätunnuksen syöttöelementtiä
 *
 * Esimerkki luokan instanssin generoimasta html-merkkijonosta:
 *
 * <pre>
 *  &lt;input type="text" name="username" id="username"/&gt;
 *  &lt;button type="button"&gt;Generoi&lt;/button&gt;
 * </pre>
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-09-12
 * @filesource
 */
class UsernameInputElement extends TextInput {

  /**
   * käytettävän etunimikentän name attribute
   *
   * @var string
   */
  private $fnameFieldName = User::FNAME;

  /**
   * käytettävän sukunimikentän name attribute
   *
   * @var string
   */
  private $lnameFieldName = User::LNAME;

  /**
   * käyttäjän tietokanta-id (käyttäjätunnuksen tarkistus)
   *
   * @var int
   */
  private $dbID;

  /**
   * Constructor
   *
   *  - **Postcondition:**   0 < $size <= $maxlength
   * @param  string $name name- ja id-attribuutin arvo
   * @param  string $value value-attribuutin arvo
   * @param  User $user käyttäjä, jolle käyttäjätunnus määritellään
   */
  function __construct($name = "username", $value = "", User $user = null) {
    if (!isset($user)) {
      $this->dbID = -1;
    } else {
      $this->dbID = $user->getPrimaryKey();
    }
    $this->addCssClass("UsernameInputElement");
    parent::__construct($name, $value, 12, 12);
    $this->setId($name . "_wrapper");
  }

  /**
   * Saves the name attribute value of the fname Input
   *
   * @param string $fnameFieldName käytettävän etunimikentän name attribute
   */
  public function setFnameFieldName($fnameFieldName) {
    $this->fnameFieldName = $fnameFieldName;
  }

  /**
   * Asettaa käytettävän sukuunimikentän nimi-attribuutin
   *
   * @param string $lnameFieldName käytettävän sukunimikentän name attribute
   */
  public function setLnameFieldName($lnameFieldName) {
    $this->lnameFieldName = $lnameFieldName;
  }

  /**
   * Asettaa käytäjän,jolle käyttäjätunnus asetetaan
   *
   * @param User $u käytettävän sukunimikentän name attribute
   */
  public function setUser(User $u) {
    $this->dbID = $u->getPrimaryKey();
  }

  /**
   * Returns the object as html-markup string.
   *
   * @return string html-markup of the object
   */
  public function __toString() {
    try {
      $genBtn = new ButtonTag("Generoi", "button");
      $genBtn->addCssClass("UsernameInputElement");
      $output = new ScriptTag("js/ownLib/autofillUsernameField.js");
      $output .= parent::__toString();
      $output .= $genBtn;
      $output .= '<script type="text/JavaScript">';
      $output .= '$("input.UsernameInputElement").autofillUsernameField({fname: "' . $this->fnameFieldName . '", lname: "' . $this->lnameFieldName . '", dbID: "' . $this->dbID . '"});';
      $output .= '</script>';
      return $output;
    } catch (Exception $e) {
      $box = new ExceptionBox($e);
      return $box->statementToString();
    }
  }

}
