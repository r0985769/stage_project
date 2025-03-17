const themePath = 'themes/custom/dierenarts_theme/';

const gulp = require('gulp');
const {series} = require('gulp');
// const {spawn} = require('child_process');
// const autoprefixer = require('gulp-autoprefixer');
// const uglify = require('gulp-uglify');
// const rename = require("gulp-rename");
const sass = require('gulp-sass')(require('sass'));

// Compile Sass to CSS
gulp.task('sass', function () {
  return gulp
    .src(themePath + 'src/css/**/*.scss')
    .pipe(sass({
      outputStyle: 'compressed'
    }).on('error', sass.logError))
    .pipe(gulp.dest(themePath + 'dist/css/'));
});


// Watch for changes in Sass files, scripts & asset folders
gulp.task('watch', function () {
  gulp.watch(themePath + 'src/css/**/*.scss', gulp.series('sass'));
//   gulp.watch(themePath + 'src/js/**/*.js', gulp.series('scripts'));
});

// Build task
gulp.task('build', series('sass'));

// Default task
gulp.task('default', series('build', 'watch'));