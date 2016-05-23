/**
 * app.js (UTF-8)
 *
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 *
 * This file is part of SPH framework.
 *
 * SPH framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SPH framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SPH framework.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
requirejs.config({
    "baseUrl": "sph/js/vendor",
    "paths": {
      "app": "../app"
    },
    "shim": {
        "ion.rangeSlider.min": ["jquery"],
        "foundation.all.min": ["jquery"]
    }
});

// Load the main app module to start the app
//http://www.dailymotion.com/video/x2h6e1n_87-539-319-numberphile_tech
//App/main.js is where the app logic is:

define(["jquery", "ion.rangeSlider.min", "foundation.all.min"], function($) {
    //the jquery.alpha.js and jquery.beta.js plugins have been loaded.
    $(function() {
        $("#example_id").ionRangeSlider();
		$(document).foundation();
		console.log($(document).foundation());
    });
});

