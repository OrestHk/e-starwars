// Require
var gulp          = require('gulp');
var concat        = require('gulp-concat');
var uglify        = require('gulp-uglify');
var sass          = require('gulp-sass');
var miniCss       = require('gulp-minify-css');
var autoprefixer  = require('gulp-autoprefixer');

// Paths
var path = {
  'resources': {
    'cssFront': './resources/assets/css/front/',
    'cssBack': './resources/assets/css/back/',
    'jsFront': './resources/assets/js/front/',
    'jsBack': './resources/assets/js/back/'
  },
  'public': {
    'css': './public/assets/css/',
    'js': './public/assets/js/'
  }
};

/* Assets Back */
// Sass
gulp.task('sassBack', function(){
  return gulp.src(path.resources.cssBack+'*.+(scss|sass)')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest(path.resources.cssBack));
});
// CSS
gulp.task('cssBack', function(){
  return gulp.src(path.resources.cssBack+'*.css')
    .pipe(autoprefixer(['> 0.2%']))
    .pipe(miniCss())
    .pipe(concat('back.min.css'))
    .pipe(gulp.dest(path.public.css));
});
// JS
gulp.task('jsBack', function(){
  return gulp.src(path.resources.jsBack+'*.js')
    .pipe(uglify())
    .pipe(concat('back.min.js'))
    .pipe(gulp.dest(path.public.js));
});


/* Assets Front */
// Sass
gulp.task('sassFront', function(){
  return gulp.src(path.resources.cssFront+'*.+(scss|sass)')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest(path.resources.cssFront));
});
// CSS
gulp.task('cssFront', function(){
  return gulp.src(path.resources.cssFront+'*.css')
    .pipe(autoprefixer(['> 0.2%']))
    .pipe(miniCss())
    .pipe(concat('front.min.css'))
    .pipe(gulp.dest(path.public.css));
});
// JS
gulp.task('jsFront', function(){
  return gulp.src(path.resources.jsFront+'*.js')
    .pipe(uglify())
    .pipe(concat('front.min.js'))
    .pipe(gulp.dest(path.public.js));
});

// Watch
gulp.task('back-watch', function(){
  gulp.watch(path.resources.jsBack+'/*.js', ['jsBack']);
  gulp.watch(path.resources.cssBack+'/**/*.+(scss|sass|css)', ['sassBack', 'cssBack']);
});
gulp.task('front-watch', function(){
  gulp.watch(path.resources.jsFront+'/*.js', ['jsFront']);
  gulp.watch(path.resources.cssFront+'/**/*.+(scss|sass|css)', ['sassFront', 'cssFront']);
});
gulp.task('watch', function(){
  gulp.watch(path.resources.jsBack+'/*.js', ['jsBack']);
  gulp.watch(path.resources.cssBack+'/**/*.+(scss|sass|css)', ['sassBack', 'cssBack']);
  gulp.watch(path.resources.jsFront+'/*.js', ['jsFront']);
  gulp.watch(path.resources.cssFront+'/**/*.+(scss|sass|css)', ['sassFront', 'cssFront']);
});

// Build
gulp.task('build', ['sassFront', 'sassBack', 'jsFront', 'jsBack','cssFront', 'cssBack']);
