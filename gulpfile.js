import gulp from "gulp";

import dartSass from 'sass'
import gulpSass from 'gulp-sass'
const sass = gulpSass(dartSass);

import sourcemaps from 'gulp-sourcemaps';
import {deleteAsync} from 'del';

gulp.task('theme-styles', () => {
    return gulp.src('sass/styles.scss')
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

gulp.task('clean', () => {
    return deleteAsync([
        'inc/css/block-style.css',
        'inc/css/style.css',
    ]);
}); 

gulp.task('watch', () => {
  gulp.watch('sass/*.scss', (done) => {
    gulp.series(['theme-styles'])(done);
  });
});

gulp.task('default', gulp.series(['theme-styles', '404-styles', 'watch']));
