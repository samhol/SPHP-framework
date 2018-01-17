// including plugins
var build, gulp = require('gulp'),
        uglify = require("gulp-uglify"),
        concat = require("gulp-concat"),
        jshint = require('gulp-jshint'),
        jsdoc = require('gulp-jsdoc3');

function build_js() {
  return gulp.src([
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
}


function doc(cb) {
  var config = require('./jsdoc.json');
  return  gulp.src(['README.md', './sphp/js/app/modules/*.js', './sphp/js/app/sphp.js'], {read: false})
          .pipe(jsdoc(config, cb));
}

//exports.build_js = build_js;
//exports.doc = doc;

build = gulp.series(build_js, doc);

gulp.task('build', build);
gulp.task('default', build);
