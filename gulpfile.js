import gulp from "gulp";

// Silence Dart Sass deprecations globally (affects this process)
if (!process.env.SASS_SILENCE_DEPRECATIONS) {
  // You can replace 'all' with a comma-separated list of IDs if you prefer fine-grained control
  process.env.SASS_SILENCE_DEPRECATIONS = 'all';
}

import dartSass from "sass";
import gulpSass from "gulp-sass";
const sass = gulpSass(dartSass);

import sourcemaps from "gulp-sourcemaps";
import { deleteAsync } from "del";

// ----------------------------------------------
// Common settings
// ----------------------------------------------
const SASS_OPTIONS = {
  outputStyle: "compressed", // nested, expanded, compact, compressed
  includePaths: ["node_modules"], // allow @import "bootstrap/..." etc.
  quietDeps: true,              // hide warnings from dependencies
  silenceDeprecations: [
    "import",          // using @import instead of @use/@forward
    "global-builtin",  // using global built-ins like unquote()
    "legacy-js-api"     // older plugin interfaces that may warn
  ],
};

const PATHS = {
  src: {
    theme: "sass/styles.scss",
    editor: "sass/editor-styles.scss", 
    notFound: "sass/404-styles.scss",
    all: "sass/**/*.scss",
  },
  dest: { 
    css: "./css/",
  },
  clean: [
    "css/*.css",
    "css/*.css.map",
  ],
};

// ----------------------------------------------
// Compile tasks
// ----------------------------------------------
export const themeStyles = () =>
  gulp
    .src(PATHS.src.theme, { allowEmpty: true })
    .pipe(sourcemaps.init())
    .pipe(sass(SASS_OPTIONS).on("error", sass.logError))
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest(PATHS.dest.css));

export const editorStyles = () =>
  gulp
    .src(PATHS.src.editor, { allowEmpty: true })
    .pipe(sourcemaps.init())
    .pipe(sass(SASS_OPTIONS).on("error", sass.logError))
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest(PATHS.dest.css));

export const notFoundStyles = () =>
  gulp
    .src(PATHS.src.notFound, { allowEmpty: true })
    .pipe(sourcemaps.init())
    .pipe(sass(SASS_OPTIONS).on("error", sass.logError))
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest(PATHS.dest.css));

// ----------------------------------------------
// Clean
// ----------------------------------------------
export const clean = () => deleteAsync(PATHS.clean);

// ----------------------------------------------
// Watch
// ----------------------------------------------
export const watchScss = () => {
  gulp.watch(PATHS.src.all, gulp.series(
    themeStyles, 
    editorStyles, 
    notFoundStyles,
  ));
};

// ----------------------------------------------
// Composite tasks
// ----------------------------------------------
export const build = gulp.series(
  clean,
  gulp.parallel(
    themeStyles,
    editorStyles,
    notFoundStyles,
  )
);

export default gulp.series(build, watchScss);
