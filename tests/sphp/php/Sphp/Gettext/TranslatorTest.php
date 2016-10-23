<?php

namespace Sphp\Core\Gettext;

/**
 */
class TranslatorTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var Translator
	 */
	protected $translator;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp() {
		$this->setLocale("fi_FI");
		$this->translator = new Translator();
	}
	
	protected function setLocale($locale) {
		Locale::setMessageLocale($locale);
	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown() {
		
	}

	/**
	 */
	public function testSingular() {
    var_dump($this->translator->get("year"));
		$this->assertEquals($this->translator->get("year"), "vuosi");
		$this->assertEquals($this->translator->get("month", "en_US"), "month");
	}

}
