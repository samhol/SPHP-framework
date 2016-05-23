<?php

namespace Sphp\Objects;
$addrData = 
	[
		Address::STREET => "Rakuunatie 59 A 3",
		Address::ZIPCODE => "20720",
		Address::CITY => "Turku",
		Address::COUNTRY => "Finland"
	];
$addr = new Address($addrData);
echo "$addr\n";
$locationData = 
	[
		Location::NAME => "My home", 
		Location::STREET => "Rakuunatie 59 A 3",
		Location::ZIPCODE => "20720",
		Location::CITY => "Turku",
		Location::COUNTRY => "Finland",
		Location::MAPLINK => "https://www.google.fi/maps/place/Rakuunatie+59,+20720+Turku"
	];
$location = new Location($locationData);
echo "$location\n";
?>