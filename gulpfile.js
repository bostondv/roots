var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var prefix = require('gulp-autoprefixer');
var minify = require('gulp-minify-css');
var sequence = require('run-sequence');
var uglify = require('gulp-uglifyjs');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var rsync = require('rsyncwrapper').rsync;
var gutil = require('gulp-util');
var imagemin = require('gulp-imagemin');
var cache = require('gulp-cache');
var args   = require('yargs').argv;
var gulpif = require('gulp-if');
var config = require('./config.json');
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
      sourcemap: true
    }))
    .pipe(prefix('last 1 version', 'ie 9'))
    .pipe(minify({ keepSpecialComments: 1 }))
    .pipe(gulp.dest(dest + 'css'));

});

gulp.task('scripts', function() {

  return gulp.src([
      bower + 'bootstrap-sass-official/assets/javascripts/bootstrap.js',
      bower + 'fitvids/jquery.fitvids.js',
      src + 'js/plugins/*.js',
      src + 'js/main.js'
    ])
    .pipe(uglify('main.js', {
      outSourceMap: true
    }))
    .pipe(gulp.dest(dest + 'js'));

});

gulp.task('admin-scripts', function() {

  return gulp.src([
      src + 'js/admin.js'
    ])
    .pipe(concat('admin.js'))
    .pipe(uglify())
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
      interlaced: true
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

gulp.task('rsync', function() {

  if ( config.servers[deployTarget].user === '' ||
       config.servers[deployTarget].host === '' ) {
    return gutil.log(gutil.colors.red('ERROR:'), 'User, host and path not configured for ' + deployTarget + ' target in config.json');
  }

  rsync({
    ssh: true,
    src: './',
    dest: config.servers[deployTarget].user + '@' + config.servers[deployTarget].host + ':' + config.servers[deployTarget].path,
    recursive: true,
    syncDest: true,
    exclude: ['node_modules', '.sass-cache'],
    args: ['--verbose']
  }, function(error, stdout, stderr, cmd) {
      gutil.log(stdout);
  });

});

gulp.task('deploy', function(cb) {

  sequence('default', 'rsync', cb);

});

gulp.task('default', ['styles', 'scripts', 'admin-scripts', 'images', 'fonts']);
