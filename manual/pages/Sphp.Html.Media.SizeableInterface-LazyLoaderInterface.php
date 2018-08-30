<?php

namespace Sphp\Html\Media;

use Sphp\Manual;

$sizeableMedia = Manual\api()->classLinker(SizeableMedia::class);
$sizeableTrait = Manual\api()->classLinker(SizeableTrait::class);
$component = Manual\api()->classLinker(\Sphp\Html\Component::class);

$lazyLoader = Manual\api()->classLinker(LazyMedia::class);
$lazyLoaderTrait = Manual\api()->classLinker(LazyMediaSourceTrait::class);

Manual\md(<<<MD
##Sizeable media content and Lazy loading 
  
$sizeableMedia is implemented by components that display resizeable visual 
media content.

Lazy Loading delays loading of $lazyLoader components in long web pages. $lazyLoader 
components outside of viewport are not loaded until user scrolls to them. Using 
Lazy Loading on large web pages will make the page load faster. In some cases it 
can also help to reduce server load. 
       
<div class="callout secondary small" markdown="1"> 
###Lazy Load XT jQuery plugin
This framework uses Lazy Load XT jQuery plugin. It is Mobile-oriented, fast 
and extensible jQuery plugin with build-in support of jQueryMobile framework.
</div>

**Trait implementations of these interfaces:** 

 * $sizeableTrait implementing $sizeableMedia.    
 * $lazyLoaderTrait implementing $lazyLoader.
 
Both of these traits can be used e.g with $component when implementing new visual media content. 
MD
);
