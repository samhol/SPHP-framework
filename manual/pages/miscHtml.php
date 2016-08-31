<?php

namespace Sphp\Html;

$dateStamp = new DateStamp(new \Datetime());
echo $dateStamp;

/*$orbitSlider = new foundation\Orbit();
$orbitSlider->appendOrbitSlide(new ImgTag("photos/2007/ETK-risteily/2007-05-26-103102_005.jpg"), "Meeting at the Amorella");
$slide2 = new foundation\OrbitSlide(new ImgTag("photos/2007/ETK-risteily/2007-05-26-103130_006.jpg"), "Meeting continues");
$slide2->setCaption("Meeting continues...");
$link2 = $slide2->getSlideLink("Slide 2");
$orbitSlider[] = $slide2;
$orbitSlider[] = new ImgTag("photos/2007/ETK-risteily/2007-05-26-103130_006.jpg");
$orbitSlider[] = new ImgTag("photos/2007/ETK-risteily/2007-05-26-103130_006.jpg");
$orbitSlider[] = new ImgTag("photos/2007/ETK-risteily/2007-05-26-103130_006.jpg");*/
//echo $orbitSlider->setStyle("width", "800px");
//echo new Div($orbitSlider->generateSlideLinks("Slide"));
(new Img("sph/image/captha.php?length=5", "Captha image"))
		->setDocumentTitle("Captha image")
		->setStyle("border", "solid 1px #000")->setStyle("padding", "1px")
		->printHtml();
$photoAlbum = new PhotoAlbum(["photos"]);
echo $photoAlbum;
echo $photoAlbum->getOpeningButton("Photoalbum");


//echo "<pre>";
//print_r($c->recursiveDirectoryIterator("photos"));
//print_r($_SERVER);
//echo "</pre>";
?>
