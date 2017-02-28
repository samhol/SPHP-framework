<?php

/**
 * CaptchaImage.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Images;

use Imagine\Gd\Imagine,
	Imagine\Image\Color,
	Imagine\Image\Palette\RGB,
	Imagine\Image\Box,
	Imagine\Image\Point,
	Imagine\Gd\Font;

/**
 * Implements a captha image
 *
 * @author  Sami Holck <sami.holck@gmail.com>, Simon Jarvis
 * @since   2014-09-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CaptchaImage {

	/**
	 * used font
	 *
	 * @var string
	 */
	private $font = '../fonts/BlackJack.ttf';
	
	/**
	 * Draws the captha image 
	 *
	 * @param  int $width the width of the image
	 * @param  int $height the height of the image
	 * @param  int $length the length of the Captha code
	 * @return self for a fluent interface
	 */
	public function draw($width = 150, $height = 50, $length = 6) {
		$code = $this->generateCode($length);
		$imagine = new Imagine();
		$palette = new RGB();
		$fontColor = $palette->color([20, 40, 100], 100);
		$image = $imagine->create(new Box($width, $height), $palette->color([255, 255, 255], 100));
		for ($i = 0; $i < ($width * $height) / 3; $i++) {
			$image->draw()->dot(
					new Point(mt_rand(0, $width), mt_rand(0, $height)), $this->getNoiseColor());
		}for ($i = 0; $i < ($width * $height) / 150; $i++) {
			$image->draw()->line(
					new Point(mt_rand(0, $width), mt_rand(0, $height)), new Point(mt_rand(0, $width), mt_rand(0, $height)), $this->getNoiseColor());
		}
		$bg = $imagine->create(new Box($width, $height), $palette->color([255, 255, 255], 100));
		$capthaText = new Font($this->font, $height * 0.6, $fontColor);
		$x = ($width - $capthaText->box($code, 14)->getWidth()) / 2;
		$y = $capthaText->box($code)->getHeight();

		$image->draw()->text($code, $capthaText, new Point($x, 5));
		$image->effects()->grayscale();

		header('Content-Type: image/png');
		echo $image->show('png');
		$this->saveCorrectCapthaCode($code);
		return $this;
	}

	/**
	 * generates a noise color object for the captha image
	 * 
	 * @param  int $min a value between 0-255
	 * @param  int $max a value between 0-255
	 * @return Color the generated noise color
	 */
	protected function getNoiseColor($min = 50, $max = 200) {
		$palette = new \Imagine\Image\Palette\RGB();
		return $palette->color([mt_rand($min, $max), mt_rand($min, $max), mt_rand($min, $max)], mt_rand(50, 100));
	}

	/**
	 * Saves the generated captha code to the session variable
	 * 
	 * @param  string $code the correct captha code
	 * @return self for a fluent interface
	 */
	protected function saveCorrectCapthaCode($code) {
		$_SESSION['security_code'] = $code;
		return $this;
	}

	/**
	 * Sets the path to the ttf font file
	 * 
	 * @param  string $fontPath the path to the ttf font file
	 * @return self for a fluent interface
	 */
	public function setFontPath($fontPath) {
		$this->font = $fontPath;
		return $this;
	}
	
	/**
	 * Checks if the given code matches to the captha
	 * 
	 * @param  string $code the code to test
	 * @return boolean true if the given code matches to the captha
	 */
	public function validateCode($code){
		return isset($_SESSION, $_SESSION['security_code']) && $_SESSION['security_code'] == $code;
	}

	/**
	 * Returns Captha code of given length
	 *
	 * @param  int $length the length of the Captha code
	 * @return string Captha code
	 */
	private function generateCode($length) {
		return substr(str_shuffle("23456789bcdfghjkmnpqrstvwxyz"), 0, $length);
	}

}