var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var prefix = require('gulp-autoprefixer');
var minify = require('gulp-minify-css');
var uglify = require('gulp-uglifyjs');
var jshint = require('gulp-jshint');
var rename = require('gulp-rename');
var util = require('gulp-util');
var imagemin = require('gulp-imagemin');
var cache = require('gulp-cache');
var cmq = require('gulp-combine-media-queries');
var size = require('gulp-size');
var src = 'app/';
var dest = 'build/';
var bower = 'components/';

var deployTarget = ( typeof args.target !== 'undefined' ? args.target : 'staging' );

gulp.task('styles', function () {

  return gulp.src([
      src + 'scss/main.scss',
      src + 'scss/editor.scss'
    ])
    .pipe(sass({
      precision: 10,
      loadPath: [
        process.cwd() + '/app/scss',
        process.cwd() + '/components'
      ]
    }))
    .pipe(prefix('last 1 version', 'ie 9'))
    .pipe(cmq())
    .pipe(minify({ keepSpecialComments: 1 }))
    .pipe(size({
      showFiles: true,
      gzip: true,
      title: 'Styles'
    }))
    .pipe(gulp.dest(dest + 'css'));

});

gulp.task('scripts', function() {

  return gulp.src([
      bower + 'bootstrap-sass-official/assets/javascripts/bootstrap.js',
      src + 'js/plugins/*.js',
      src + 'js/main.js'
    ])
    .pipe(uglify('main.js', {
      outSourceMap: true,
      basePath: 'build/js'
    }))
    .pipe(size({
      gzip: true,
      title: 'Scripts'
    }))
    .pipe(gulp.dest(dest + 'js'));

});

gulp.task('admin-scripts', function() {

  return gulp.src([
      src + 'js/admin.js'
    ])
    .pipe(uglify('admin.js', {
      outSourceMap: true,
      basePath: 'build/js'
    }))
    .pipe(size({
      gzip: true,
      title: 'Admin Scripts'
    }))
    .pipe(gulp.dest(dest + 'js'));

});

gulp.task('lint', function() {

  return gulp.src(src + 'js/*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(jshint.reporter('fail'));
});

gulp.task('images', function() {
  return gulp.src(src + 'img/**/*')
    .pipe(cache(imagemin({
      optimizationLevel: 5,
      progressive: true,
      interlaced: true,
      svgoPlugins: [
        { removeUselessStrokeAndFill: false }
      ]
    })))
    .pipe(gulp.dest(dest + 'img'));
});

gulp.task('fonts', function() {
  return gulp.src(src + 'font/*')
    .pipe(gulp.dest(dest + 'font'));
});

gulp.task('watch', function () {

  gulp.watch(src + 'scss/**/*.scss', ['styles']);
  gulp.watch(src + 'js/**/*.js', ['scripts']);
  gulp.watch(src + 'img/**/*', ['images']);

});

gulp.task('clearCache', function() {
  cache.clearAll();
});

gulp.task('default', ['styles', 'scripts', 'admin-scripts', 'images', 'fonts']);
