<?php

use Sphp\Html\Media\Icons\FontAwesome;
?>
<div class="grid-container">
  <div class="grid-x grid-margin-x grid-padding-x">
    <div class="cell small-12 large-auto">
      <section class="contact-information">
        <h2>Contact information:</h2>
        <div class="media-object">
          <div class="media-object-section">
            <div class="thumbnail">
              <img style="height:100px" src="http://data.samiholck.com/images/face_modified.jpg" alt="Photo of Sami Holck">
            </div>
          </div>
          <div class="media-object-section main-section">
            <ul class="fa-ul">
              <li><span class="fa-li"><?php FontAwesome::phone('phonenumber')->printHtml() ?></span> +358 44 298 6738</li>
              <li><span class="fa-li"><?php FontAwesome::envelope('Email address')->printHtml() ?></span> sami.holck@gmail.com</li>
              <li><span class="fa-li"><i class="fa fa-map-marker-alt"></i></span><a href="https://goo.gl/maps/YX5cY72aXgp">Rakuunatie 59 A3, Turku, Finland</a></li>
              <li><span class="fa-li"><i class="fab fa-whatsapp"></i></span><a href="https://api.whatsapp.com/send?phone=358442986738">whatsapp</a></li>
            </ul>
          </div>
        </div>
      </section>
    </div>

    <div class="cell small-12 large-shrink">
      <section class="contact-information">
        <h2>Social media:</h2>
        <ul class="social-icons">
          <li><a href="https://github.com/samhol">
              <i class="fab fa-github fa-fw" aria-hidden="true"></i>
              <span class="show-for-sr">GitHub repository</span>
            </a></li>
          <li><a href="https://stackoverflow.com/users/6288052/sami-holck">
              <i class="fab fa-stack-overflow fa-fw" aria-hidden="true"></i>
              <span class="show-for-sr">stackoverflow page</span>
            </a></li>
          <li><a href="https://www.facebook.com/sami.holck">
              <i class="fab fa-facebook-f fa-fw" aria-hidden="true"></i>
              <span class="show-for-sr">Facebook page</span>
            </a></li>
          <li><a href="https://twitter.com/samiholck">
              <i class="fab fa-twitter fa-fw" aria-hidden="true"></i>
              <span class="show-for-sr">Twitter page</span>
            </a></li>
        </ul>
      </section>
    </div>
  </div>
</div>