var gulp = require('gulp');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var order = require('gulp-order');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var cssnano = require('gulp-cssnano');

gulp.task('sass', function(){
  return gulp.src('dev/scss/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(cssnano())
    .pipe(sourcemaps.write('../dev/maps'))
    .pipe(gulp.dest('dist'))
});

gulp.task('js', function(){
  return gulp.src('dev/js/**/*.js')
    .pipe(sourcemaps.init())
    .pipe(order([
      'vendor/**/*.js',
      '9_custom-scripts.js'
    ]))
    .pipe(concat('custom-scripts.min.js'))
    .pipe(uglify({
      output: {
        comments: '/^!/'
      }
    }))
    .pipe(sourcemaps.write('../../dev/maps',{includeContent:false, sourceRoot: 'dist'}))
    .pipe(gulp.dest('dist/js'))
});

gulp.task('watch', function(){
  gulp.watch('dev/scss/**/*.scss', gulp.series('sass'));
  gulp.watch('dev/js/*.js', gulp.series('js'));
});

gulp.task('default', gulp.parallel(['js', 'sass', 'watch']));