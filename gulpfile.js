const gulp = require('gulp');
const sass = require('gulp-sass');
const del = require('del');

gulp.task('styles', () => {
    return gulp.src('sass/style.scss')
        .pipe(sass({
          includePaths: ['sass/**/*.scss'],
          outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(gulp.dest('.'))
});

gulp.task('clean', () => {
    return del([
        'style.css',
    ]);
});

gulp.task('watch', () => {
    gulp.watch('sass/**/*.scss', (done) => {
        gulp.series(['clean', 'styles'])(done);
    });
});

gulp.task('default', gulp.series(['clean', 'styles']));
