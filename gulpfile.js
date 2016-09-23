var gulp = require('gulp'),
  compass = require('gulp-compass'),
  coffee = require('gulp-coffee'),
  concat = require('gulp-concat'),
  uglify = require('gulp-uglify'),
  watch = require('gulp-watch'),
  autoprefixer = require('gulp-autoprefixer'),
  cleanCSS = require('gulp-clean-css'),
  theme = 'wp-content/themes/nome_do_tema/';

// Error
function onError(err) {
  console.log(err);
  this.emit('end');
}

// Buld
gulp.task('build', ['compass', 'coffee', 'scripts', 'styles', 'watch']);

// Default
gulp.task('default', ['build', 'watch']);

// Coffee
gulp.task('coffee', function() {
  gulp.src(theme + 'assets/coffee/**/*.coffee')
    .pipe(coffee({bare: true}))
    .on('error', onError)
    .pipe(gulp.dest(theme + 'assets/js'));
});

// Compass
gulp.task('compass', function() {
  gulp.src(theme + 'assets/sass/**/*.scss')
    .pipe(compass({
      config_file: 'config.rb',
      css: theme + 'assets/css',
      font: theme + 'assets/fonts',
      sass: theme + 'assets/sass',
      image: theme + 'assets/images'
    }))
    .on('error', onError)
})

// Scripts
gulp.task('scripts', function() {
  return gulp.src([
    // theme + 'assets/bower_components/jquery/dist/jquery.min.js',
    ])
    .pipe(concat('app.js', {
      outSourceMap: true
    }))
    .pipe(uglify())
    .on('error', onError)
    .pipe(gulp.dest(theme + 'assets/js'));
});

// Styles
gulp.task('styles', function() {
  return gulp.src([
      theme + 'assets/css/app.css'
    ])
    .pipe(cleanCSS({
      compatibility: 'ie8',
      keepSpecialComments: 0})
    )
    .on('error', onError)
    .pipe(concat('styles.css'))
    .pipe(autoprefixer({
      browsers: ['last 10 versions'],
      cascade: false
    }))
    .pipe(gulp.dest(theme + 'assets/css'));
});

// Watch
gulp.task('watch', function() {
  gulp.watch(theme + 'assets/sass/**/*.scss', ['compass'])
  gulp.watch(theme + 'assets/coffee/**/*.coffee', ['coffee'])
  gulp.watch([theme + 'assets/css/**/*.css', '!' + theme + 'assets/css/styles.css'], ['styles'])
  gulp.watch([theme + 'assets/js/**/*.js', '!' + theme + 'assets/js/app.js'], ['scripts'])
});
