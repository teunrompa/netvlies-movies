const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const minify = require('gulp-clean-css');
const prefix = require('gulp-autoprefixer');

function buildStyles() {
  return gulp
    .src("./scss/**/*.scss")
    .pipe(sass().on("error", sass.logError))
    .pipe(prefix())
    .pipe(minify())
    .pipe(gulp.dest("./css"));
}

function watch(){
  gulp.watch("./scss/**/*.scss", buildStyles);
}

exports.buildStyles = buildStyles;
exports.watch = watch;