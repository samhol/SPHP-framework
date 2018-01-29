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
    './sphp/javascript/vendor/*.js',
    './sphp/javascript/app/modules/*.js',
    './sphp/javascript/app/sphp.js'
  ])
          .pipe(jshint())
          //.pipe(jshint.reporter('.sphp/js/logs/lint.log'))
          .pipe(uglify())
          .pipe(concat('all.js'))
          .pipe(gulp.dest('sphp/javascript/dist'));
}

function build_ss360() {
  return gulp.src([
    './sphp/javascript/app/ss360/*.js'
  ])
          .pipe(jshint())
          //.pipe(jshint.reporter('.sphp/js/logs/lint.log'))
          .pipe(uglify())
          .pipe(concat('ss360.min.js'))
          .pipe(gulp.dest('sphp/javascript/dist'));
}

function doc(cb) {
  var config = require('./jsdoc.json');
  return  gulp.src(['README.md', './sphp/javascript/app/sphp.js', './sphp/javascript/app/ss360/*.js', './sphp/javascript/app/modules/*.js'], {read: false})
          .pipe(jsdoc(config, cb));
}

//exports.build_js = build_js;
//exports.doc = doc;

build = gulp.series(build_js, doc, build_ss360);

gulp.task('build', build);
gulp.task('default', build);
