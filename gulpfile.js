var gulp = require('gulp');
var sass = require('gulp-ruby-sass');
var prefix = require('gulp-autoprefixer');
var minify = require('gulp-minify-css');
var sequence = require('run-sequence');
var uglify = require('gulp-uglify');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var rename = require('gulp-rename');

var paths = {
  css: 'assets/css',
  scss: 'assets/scss',
  scripts: 'assets/js',
  images: 'assets/img',
  bower: 'assets/components'
};

gulp.task('sass', function () {

  return gulp.src(paths.scss + '/main.scss')
    .pipe(sass())
    .pipe(gulp.dest(paths.css));

});

gulp.task('css', function () {

  return gulp.src(paths.css + '/main.css')
    .pipe(prefix('last 1 version', 'ie 9'))
    .pipe(minify({ keepSpecialComments: 1 }))
    .pipe(rename('main.min.css'))
    .pipe(gulp.dest(paths.css));

});

gulp.task('scripts', function() {

  return gulp.src([
      paths.bower + '/bootstrap-sass-official/vendor/assets/javascripts/bootstrap.js',
      paths.bower + '/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/affix.js',
      paths.bower + '/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/alert.js',
      paths.bower + '/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/button.js',
      paths.bower + '/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/carousel.js',
      paths.bower + '/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/collapse.js',
      paths.bower + '/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/dropdown.js',
      paths.bower + '/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tab.js',
      paths.bower + '/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/transition.js',
      paths.bower + '/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/scrollspy.js',
      paths.bower + '/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/modal.js',
      paths.bower + '/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tooltip.js',
      paths.bower + '/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/popover.js',
      paths.bower + '/fitvids/jquery.fitvids.js',
      paths.scripts + '/plugins/*.js',
      paths.scripts + '/_*.js'
    ])
    .pipe(concat('scripts.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest(paths.scripts));

});

gulp.task('lint', function() {

  return gulp.src(paths.scripts + '/_*.js')
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(jshint.reporter('fail'));
});

gulp.task('watch', function () {

  gulp.watch(paths.scss + '/**/*.scss', ['styles']);
  gulp.watch(paths.scripts + '/**/*.js', ['scripts']);

});

gulp.task('styles', function (cb) {

  sequence('sass', 'css', cb);

});

gulp.task('default', ['styles', 'scripts']);
