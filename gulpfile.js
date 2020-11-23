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

gulp.task('block-styles', () => {
    return gulp.src('sass/block-styles.scss')
        .pipe(sass({
          outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(gulp.dest('./css/'))
});

gulp.task('slick-styles', () => {
    return gulp.src('sass/slick.scss')
        .pipe(sass({
          outputStyle: 'compressed'
        }).on('error', sass.logError))
        .pipe(gulp.dest('./css/'))
});

gulp.task('clean', () => {
    return del([
        'style.css',
    ]);
});

gulp.task('watch', () => {
    gulp.watch('sass/**/*.scss', (done) => {
        gulp.series(['clean', 'styles', 'block-styles', 'slick-styles'])(done);
    });
});

gulp.task('default', gulp.series(['watch']));
