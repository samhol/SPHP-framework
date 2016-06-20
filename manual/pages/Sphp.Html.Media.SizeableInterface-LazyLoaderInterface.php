<?php

namespace Sphp\Html\Media;

$sizeableInterface = $api->getClassLink(SizeableInterface::class);
$sizeableTrait = $api->getClassLink(SizeableTrait::class);
$size = $api->getClassLink(Size::class);
//$video = $api->getClassLink(Video::class);
//$iframe = $api->getClassLink(Iframe::class);
//$img = $api->getClassLink(Img::class);
//$embed = $api->getClassLink(Embed::class);
//$audio = $api->getClassLink(Figure::class);
//$abstractVideoPlayer = $api->getClassLink(AbstractVideoPlayer::class);
//$youtubePlayer = $api->getClassLink(YoutubePlayer::class);

//$vimeoPlayer = $api->getClassLink(VimeoPlayer::class);
$componentInterface = $api->getClassLink(\Sphp\Html\ComponentInterface::class);

$lazyLoader = $api->getClassLink(LazyLoaderInterface::class);
$lazyLoaderTrait = $api->getClassLink(LazyLoaderTrait::class);
$abstractIframe = $api->getClassLink(AbstractIframe::class);

echo $parsedown->text(<<<MD
##Sizeable media content and Lazy loading 
		
$sizeableInterface is implemented by components that display resizeable visual 
media content. The sizes of these components are managed by $size objects.
		
Lazy Loading delays loading of $lazyLoader components in long web pages. $lazyLoader 
components outside of viewport are not loaded until user scrolls to them. Using 
Lazy Loading on long web pages will make the page load faster. In some cases it 
can also help to reduce server load. 

**Trait implementations of these interfaces:** 

 * $sizeableTrait implementing $sizeableInterface.    
 * $lazyLoaderTrait can be used e.g $componentInterface implementing $lazyLoader.
 
Both traits can be used e.g with $componentInterface when implementing new visual media content. 
MD
);
