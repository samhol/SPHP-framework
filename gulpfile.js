// including plugins
var gulp = require('gulp'),
        uglify = require("gulp-uglify"),
        concat = require("gulp-concat"),
        jshint = require('gulp-jshint'),
        removeUseStrict = require("gulp-remove-use-strict");

gulp.task('build-js', function () {
  gulp.src([
    './node_modules/jquery/dist/jquery.js',
    './node_modules/foundation-sites/dist/js/foundation.js',
    './node_modules/clipboard/dist/clipboard.js',
    './node_modules/lazyloadxt/dist/jquery.lazyloadxt.extra.js',
    './node_modules/ion-rangeslider/js/ion.rangeSlider.js',
    './sphp/js/vendor/*.js',
    './sphp/js/app/modules/*.js',
    './sphp/js/app/sphp.js'
  ])
          .pipe(jshint())
          //.pipe(jshint.reporter('.sphp/js/logs/lint.log'))
          .pipe(uglify())
          .pipe(concat('all.js'))
          .pipe(gulp.dest('sphp/js/dist'));
});
