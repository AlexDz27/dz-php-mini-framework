var gulp = require('gulp');
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
var browserSync = require('browser-sync');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var csso = require('gulp-csso');
var rename = require('gulp-rename');
var del = require('del');
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');
var cache = require('gulp-cache');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');


gulp.task('watch', ['scripts-dev'], function() {
  console.log('Watching SCSS files and JS files');
  gulp.watch('front-dev/scss/**/*.scss', ['sass']);
  gulp.watch('front-dev/js/*.js', ['scripts-dev']);
});

gulp.task('sass', function(){
  return gulp.src('front-dev/scss/**/main.scss')
    .pipe(plumber())
    .pipe(sass())
    .pipe(postcss([ autoprefixer() ]))
    .pipe(gulp.dest('public/css'))
    .pipe(browserSync.reload({stream: true}))
});

gulp.task('scripts-dev', function() {
  // Берем либы, вместе с ними берем наш мейн файл
  return gulp.src([
    'front-dev/js/libs/jquery-3.3.1.min.js',
    'front-dev/js/libs/*.js',
    'front-dev/js/main.js',
  ])
    .pipe(concat('scripts.js'))
    // .pipe(uglify()) // Must be when prod
    .pipe(gulp.dest('public/js'))
    .pipe(browserSync.reload({stream: true}));
});

gulp.task('build', ['cleanProdFolder', 'minify-img', 'css-libs-dev', 'scripts-dev'], function () {
  var buildCss = gulp.src([
    'front-dev/css/main.css'
  ])
    .pipe(csso())
    .pipe(rename('main.min.css'))
    .pipe(gulp.dest('prod/css'));

  var buildFonts = gulp.src([
    'front-dev/fonts/**/*'
  ])
    .pipe(gulp.dest('prod/fonts'));

  var buildJs = gulp.src('front-dev/js/scripts.js')
    .pipe(uglify())
    .pipe(rename('scripts.min.js'))
    .pipe(gulp.dest('prod/js'));

  var buildHtml = gulp.src('front-dev/*.html')
    .pipe(gulp.dest('prod'));
});

gulp.task('cleanProdFolder', function() {
  return del.sync('prod');
});

gulp.task('minify-img', function() {
  return gulp.src('front-dev/img/**/*')
    .pipe(cache(imagemin({
      interlaced: true,
      progressive: true,
      svgoPlugins: [{removeViewBox: false}],
      use: [pngquant()]
    })))
    .pipe(gulp.dest('prod/img'))
});

gulp.task('clear-cache', function () {
  return cache.clearAll();
});

gulp.task('default', ['watch']);