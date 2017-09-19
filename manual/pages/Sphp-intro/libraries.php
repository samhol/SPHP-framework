<?php
use Sphp\Manual\SoftwareVersions;
 
$parsedownVersion = Parsedown::version;
$parsedownExtraVersion = ParsedownExtra::version;
$parsedownExtraPluginVersion = ParsedownExtraPlugin::version;
?>

##What is currently under the hood?
<div class="row sphp-intro">
<div class="column small-12 medium-6" markdown="1">  
###Server side:
 * [**Doctrine** <?php echo SoftwareVersions::doctrineCommon(); ?>](http://www.doctrine-project.org/){target="_blank"} — <i class="tech label php"></i><i class="tech label sql"></i>
   * [**...DBAL** <?php echo SoftwareVersions::doctrineDBAL(); ?>](http://www.doctrine-project.org/projects/dbal.html){target="_blank"}
   * [**...ORM** <?php echo SoftwareVersions::doctrineORM(); ?>](http://www.doctrine-project.org/projects/orm.html){target="_blank"}
   * [**...Cache** <?php echo SoftwareVersions::doctrineCommonCache(); ?>](http://doctrine-orm.readthedocs.io/projects/doctrine-orm/en/latest/reference/caching.html){target="_blank"}
 * [**GeSHi** <?php echo SoftwareVersions::geshi(); ?>](http://qbnz.com/highlighter/){target="_blank"} — <i class="tech label php"></i>
 * [**Imagine**](https://imagine.readthedocs.org/){target="_blank"} — <i class="tech label php"></i>
 * [**Parsedown** <?php echo $parsedownVersion; ?>](https://github.com/erusev/parsedown-extra){target="_blank"} — <i class="tech label php"></i>
   * [**... Extra** <?php echo $parsedownExtraVersion; ?>](https://github.com/erusev/parsedown-extra){target="_blank"} — <i class="tech label php"></i>
   * [**... Extra Plugin** <?php echo $parsedownExtraPluginVersion; ?>](https://github.com/erusev/parsedown-extra){target="_blank"} — <i class="tech label php"></i>
</div>
  
<div class="column small-12 medium-6" markdown="1"> 
###Client side:
 * [**jQuery**](http://jQuery.com){.jquery_version target="_blank"} <i class="tech label js"></i>
   * [**Foundation** for Sites](http://foundation.zurb.com/){.foundation_version target="_blank"} <i class="tech label html5"></i><i class="tech label css3"></i><i class="tech label js"></i>
   * [**Any+Time™**](http://www.ama3.com/anytime/){.anytime_version target="_blank"} <i class="tech label js"></i><i class="tech label css3"></i>
   * [**Lazy Load XT**](http://ressio.github.io/lazy-load-xt/){target="_blank"} <i class="tech label js"></i>
   * [**Ion.RangeSlider**](https://github.com/IonDen/ion.rangeSlider){target="_blank"} <i class="tech label js"></i><i class="tech label css3"></i>
   * [**qTip<sup>2</sup>**](http://qtip2.com/){target="_blank"} <i class="tech label js"></i> <i class="tech label css3"></i>
 * [**Video.js player**](http://videojs.com/){target="_blank"} <i class="tech label js"></i><i class="tech label css3"></i>
 * [**clipboard.js**](https://clipboardjs.com/){target="_blank"} <i class="tech label js"></i>

</div>
</div>
