<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Apps\Slick\Carousel;
?>
<div class="grid-x sphp-slick-container"> 
  <div class="cell auto">

    <?php
    $settings = [
        'dots' => true,
        'infinite' => true,
        'speed' => 3000,
        'slidesToShow' => 3,
        'slidesToScroll' => 1,
        'responsive' =>
        [
            [
                'breakpoint' => 1200,
                'settings' => [
                    'slidesToShow' => 3,
                    'dots' => true
                ]
            ],
            [
                'breakpoint' => 1024,
                'settings' => [
                    'slidesToShow' => 2,
                    'dots' => true
                ]
            ],
            [
                'breakpoint' => 640,
                'settings' => [
                    'slidesToShow' => 1,
                    'dots' => false
                ]
            ],
        ]
    ];
    $videoCarousel = new Carousel($settings);
    $videoCarousel->appendYoutubeVideo('u0eJRXOOikg')->setAspectRatio('widescreen')->setLazy();
    $videoCarousel->appendYoutubeVideo('wng6c0oLkQE')->setAspectRatio('widescreen')->setLazy();
    $videoCarousel->appendYoutubeVideo('QmOT6-MfK14')->setAspectRatio('widescreen')->setLazy();
    $videoCarousel->appendYoutubeVideo('0NbBjNiw4tk')->setAspectRatio('widescreen')->setLazy();
    echo $videoCarousel;
    ?>


  </div>
</div>
