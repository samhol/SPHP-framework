<?php

namespace Sphp\Html\Media;

$path = 'manual/pics/error.png';

echo \ParsedownExtra::instance()->text(<<<TEXT

#404: <small>Manual page not found!</small>{.error}

**The page you requested does not exist**!
        
   
TEXT
);


/*$s25 = new Size(25, 25);
$s50 = new Size(50, 50);
$s100 = new Size(100, 100);
$s150 = new Size(150, 150);
Img::scaleToFit($path, $s25)->setLazy()->setAlt('25px')->printHtml();
Img::scaleToFit($path, $s50)->setLazy()->setAlt('50px')->printHtml();
Img::scaleToFit($path, $s100)->setLazy()->setAlt('100px')->printHtml();
Img::scaleToFit($path, $s150)->setLazy()->setAlt('150px')->printHtml();
Img::scaleToFit($path, $s100)->setLazy()->setAlt('100px')->printHtml();
Img::scaleToFit($path, $s50)->setLazy()->setAlt('50px')->printHtml();
Img::scaleToFit($path, $s25)->setLazy()->setAlt('25px')->printHtml();
*/
namespace Sphp\Html\Apps\Freefind;
use Sphp\Html\Adapters\QtipAdapter;
$form = new FreefindSearchForm('r', '51613081', '&#247;', '0');

$form->getSearchField()->setName('query')->setPlaceholder('keywords in documentation');
echo "\n";
(new QtipAdapter($form->getSubmitButton()))->setQtipPosition('bottom right', 'top center')->setQtip('Execute Search');
$form->printHtml();

?>

<pre>
  <?php
  /* print_r($_SERVER);
    print_r($_FILES);
    print_r(headers_list());
    print_r(http_response_code()); */

  ?>
</pre>
<!-- start
<form action="http://search.freefind.com/find.html" method="get" accept-charset="utf-8" target="_self" id="freefind">
  <div class="input-group">
    <span class="input-group-label">Search for:</span>
    <input type="hidden" name="si" value="51613081">
    <input type="hidden" name="pid" value="r">
    <input type="hidden" name="n" value="0">
    <input type="hidden" name="_charset_" value="">
    <input type="hidden" name="bcd" value="&#247;">
    <input type="search" placeholder="keywords in documentation" class="input-group-field" name="query"> 
    <div class="input-group-button">
      <button type="submit" class="button" value="search" data-sphp-qtip-viewport="#freefind" data-sphp-qtip data-sphp-qtip-at="top center" data-sphp-qtip-my="bottom right" title="Execute search"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
  </div>
</form>

<a style="text-decoration:none; color:gray;" href="http://www.freefind.com" >site search</a><a style="text-decoration:none; color:gray;" href="http://www.freefind.com" > by
  <span style="color: #606060;">freefind</span></a>



 -->
 
 <!-- start of freefind search box html -->
<table cellpadding=0 cellspacing=0 border=0 >
<tr>
	<td  style="font-family: Arial, Helvetica, sans-serif; font-size: 7.5pt;">
		<center><table width="90%" cellpadding=0 cellspacing=0 border=0  style="font-family: Arial, Helvetica, sans-serif; font-size: 7.5pt;">
		<tr>
			<td style="font-family: Arial, Helvetica, sans-serif; font-size: 7.5pt;" align=left ><a href="http://search.freefind.com/siteindex.html?si=51613081">index</a></td>
			<td style="font-family: Arial, Helvetica, sans-serif; font-size: 7.5pt;" align=center><a href="http://search.freefind.com/find.html?si=51613081&amp;m=0&amp;p=0">sitemap</a></td>
			<td style="font-family: Arial, Helvetica, sans-serif; font-size: 7.5pt;" align=right><a href="http://search.freefind.com/find.html?si=51613081&amp;pid=a">advanced</a></td>
		</tr>
		</table></center>
		<form style="margin:0px; margin-top:4px;" action="http://search.freefind.com/find.html" method="get" accept-charset="utf-8" target="_self">
		<input type="hidden" name="si" value="51613081">
		<input type="hidden" name="pid" value="r">
		<input type="hidden" name="n" value="0">
		<input type="hidden" name="_charset_" value="">
		<input type="hidden" name="bcd" value="&#247;">
		<input type="text" name="query" size="15"> 
		<input type="submit" value="search">
		</form>
	</td>
</tr>
<tr>
	<td style="text-align:center; font-family: Arial, Helvetica, sans-serif;	font-size: 7.5pt; padding-top:4px;">
		<a style="text-decoration:none; color:gray;" href="http://www.freefind.com" >search engine</a><a style="text-decoration:none; color:gray;" href="http://www.freefind.com" > by
		<span style="color: #606060;">freefind</span></a>
	</td>
</tr>
</table>
<!-- end of freefind search box html -->


