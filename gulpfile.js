const gulp = require('gulp');
const sass = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const del = require('del');

gulp.task('styles', () => {
    return gulp.src('sass/style.scss')
      .pipe(sourcemaps.init())
      .pipe(sass({
        includePaths: ['sass/**/*.scss'],
        outputStyle: 'compressed' //nested, expanded, compact, compressed
      }).on('error', sass.logError))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest('./css/'))
});


gulp.task('block-styles', () => {
    return gulp.src('sass/block-styles.scss')
      .pipe(sourcemaps.init())
      .pipe(sass({
        outputStyle: 'compressed'//nested, expanded, compact, compressed
      }).on('error', sass.logError))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest('./css/'))
});


gulp.task('404-styles', () => {
    return gulp.src('sass/404-styles.scss')
      .pipe(sourcemaps.init())
      .pipe(sass({
        outputStyle: 'compressed'//nested, expanded, compact, compressed
      }).on('error', sass.logError))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest('./css/'))
});


gulp.task('watch', () => {
  gulp.watch('sass/**/*.scss', (done) => {
    gulp.series(['styles', 'block-styles', '404-styles'])(done);
  });
});

gulp.task('default', gulp.series(['watch']));
