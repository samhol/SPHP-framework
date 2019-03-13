// including plugins
var build, gulp = require('gulp'),
        watch = require('gulp-watch'),
        uglify = require("gulp-uglify"),
        concat = require("gulp-concat"),
        jsdoc = require('gulp-jsdoc3'),
        rev = require('gulp-rev'),
        revReplace = require('gulp-rev-replace'),
        sass = require('gulp-sass'),
        copy_scss_and_fonts;

sass.compiler = require('node-sass');

function build_js() {
  return gulp.src([
    './node_modules/jquery/dist/jquery.js',
    './node_modules/clipboard-polyfill/build/clipboard-polyfill.promise.js',
    './node_modules/slick-carousel/slick/slick.min.js',
    './node_modules/foundation-sites/dist/js/foundation.js',
    './node_modules/lazyloadxt/dist/jquery.lazyloadxt.extra.js',
    './node_modules/ion-rangeslider/js/ion.rangeSlider.js',
    './node_modules/tipso/src/tipso.js',
    './sphp/javascript/vendor/*.js',
    './sphp/javascript/app/modules/*.js',
    './sphp/javascript/app/sphp.js'
  ])
          .pipe(uglify())
          .pipe(concat('all.js'))
          .pipe(gulp.dest('./sphp/javascript/dist'));
}

function copy_scss() {
  return gulp
          .src(['./node_modules/slick-carousel/slick/*.scss'])
          .pipe(gulp.dest('./sphp/scss/vendor/slick-carousel'));
}
function copy_fonts() {
  return gulp
          .src(['./node_modules/slick-carousel/slick/fonts/*'])
          .pipe(gulp.dest('./sphp/css/fonts'));
}


function copy_img() {
  console.log('copy_img');
  return gulp
          .src(['./node_modules/slick-carousel/slick/ajax-loader.gif'])
          .pipe(rev())
          .pipe(revReplace())
          .pipe(gulp.dest('./sphp/css/images/ajax-loader.gif'));
}

function copy_tipso() {
  return gulp.src('./node_modules/tipso/src/tipso.css')
          .pipe(rev())
          .pipe(rename(function (file) {
            file.extname = '_tipso.scss';
          }))
          .pipe(revReplace())
          .pipe(gulp.dest('./sphp/scss/vendor'));
}

function build_ss360() {
  return gulp.src([
    './sphp/javascript/app/ss360/*.js'
  ])
          .pipe(uglify())
          .pipe(concat('ss360.min.js'))
          .pipe(gulp.dest('./sphp/javascript/dist'));
}

function doc(cb) {
  var config = require('./jsdoc.json');
  return  gulp.src([
    'README.md',
    './sphp/javascript/app/sphp.js',
    './sphp/javascript/app/ss360/*.js',
    './sphp/javascript/app/modules/*.js'], {read: false})
          .pipe(jsdoc(config, cb));
}


build = gulp.series(build_js, build_ss360);
build_docs = gulp.series(build, doc);
copy_scss_and_fonts = gulp.series(copy_scss, copy_fonts, copy_img, copy_tipso);

gulp.task('build', build);
gulp.task('default', build);
gulp.task('copy:scss+fonts', copy_scss_and_fonts);
gulp.task('doc', doc);

function sassToCss() {
  return gulp.src('./sphp/scss/*.scss')
          .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
          .pipe(gulp.dest('./sphp/css'));
}
gulp.task('sass', sassToCss);

gulp.task('sass:watch', function () {
  gulp.watch('./sphp/scss/**/*.scss', ['sass']);
});