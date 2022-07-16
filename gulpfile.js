// including plugins

const gulp = require('gulp');
const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const terser = require('gulp-terser');
//jsdoc = require('gulp-jsdoc3'),
const rev = require('gulp-rev');
const revReplace = require('gulp-rev-replace');
const sass = require('gulp-dart-sass');

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



copy_scss_and_fonts = gulp.series(copy_fonts, copy_img);

gulp.task('copy:scss+fonts', copy_scss_and_fonts);


gulp.task('javascript', function () {
  return gulp.src([
    './node_modules/jquery/dist/jquery.js',
    './node_modules/bootstrap/dist/js/bootstrap.bundle.js',
    './node_modules/anchor-js/anchor.js',
    './node_modules/slick-carousel/slick/slick.min.js',
    './node_modules/flatpickr/dist/flatpickr.min.js',
    //'./node_modules/lozad/dist/lozad.min.js',
    "./node_modules/ion-rangeslider/js/ion.rangeSlider.js",
    './sphp/client/js/modules/*.js',
    './sphp/client/js/modules/manual/*.js', 
  ])
          .pipe(concat('all.js'))
          .pipe(terser({
            compress: true,
            format: {
              comments: false
            },
            keep_fnames: false,
            mangle: true
          }))
          .pipe(sourcemaps.write('./maps'))
          .pipe(gulp.dest('./sphp/client/js'));
});
const SCSS_PATH = './sphp/client/scss/**/*.scss';
const JS_PATH = './sphp/client/js/modules/**/*.js';
gulp.task('scss', function () {
  return gulp.src([SCSS_PATH])
          .pipe(sourcemaps.init())
          .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
          .pipe(sourcemaps.write('./maps'))
          .pipe(gulp.dest('./sphp/client/css'));
});


gulp.task('file_watch', function () {
  gulp.watch(SCSS_PATH, gulp.series('scss'));
  gulp.watch([
    JS_PATH,
    './sphp/client/js/modules/manual/*.js'
  ], gulp.series('javascript'));
});

gulp.task('build-all', gulp.series('scss', 'javascript'));

